<?php
/***/
namespace App\Http\Controllers;

use App\Models\ReservationItem;
use App\Models\User;
use App\Models\Reservation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    /** Muestra una lista de reservas recientes. */
    public function index()
    {
        $reservations = Reservation::with('user')->latest()->limit(10)->get();
        return response()->json($reservations);
    }

    public function checkout(Reservation $reservation)
    {
        if ($reservation->estado != 'PENDIENTE_PAGO') {
            return redirect()->route('reservation.show', $reservation->id)
                ->with('warning', 'Esta reserva ya ha sido pagada o procesada.');
        }
        return view('reservations.checkout', compact('reservation'));
    }

    /** Crea la reserva provisional y redirige al flujo de pago (Para Blade). */
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $validatedData = $request->validate([
                'fk_user' => 'required|exists:users,id',
                'total' => 'required|numeric|min:0',
                'retiro' => 'required|date',
            ]);

            $validatedData['estado'] = 'PENDIENTE_PAGO'; 
            $reservation = Reservation::create($validatedData);

            // Redirigir al checkout para forzar el pago
            $paymentRoute = route('checkout.pago', ['reservation' => $reservation->id]); 

            return redirect($paymentRoute)->with('success', '¡Reserva creada! Por favor, completa el pago para confirmar tu pedido.');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error al crear la reserva: ' . $e->getMessage());
            return back()->with('error', 'Error al crear la reserva.')->withInput();
        }
    }

    /** Procesa la confirmación del pago y actualiza el estado de la reserva. */
    public function requestPaymentAsIntermediary(Request $request, Reservation $reservation)
    {
        if ($reservation->estado != 'PENDIENTE_PAGO') {
             return response()->json([
                 'message' => 'La reserva ya fue procesada o no está pendiente de pago.'
             ], 409);
        }

        // Simulación de procesamiento de pago externo
        $paymentSuccess = true;

        if ($paymentSuccess) {
            DB::beginTransaction();
            try {
                $reservation->update(['estado' => 'pagada']);
                DB::commit();

                return response()->json([
                    'message' => 'Pago procesado y reserva actualizada a "pagada".',
                    'reservation' => $reservation
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error en la transacción de pago para reserva ' . $reservation->id . ': ' . $e->getMessage());
                return response()->json([
                    'message' => 'Error en el registro del pago interno.',
                    'error' => $e->getMessage()
                ], 500);
            }
        } else {
            return response()->json(['message' => 'El pago con el intermediario falló.'], 400);
        }
    }
}
