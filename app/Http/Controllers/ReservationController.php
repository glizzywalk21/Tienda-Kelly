<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    /** Listado de reservas (Admin) con búsqueda por texto */
    public function index(Request $request)
    {
        $q = trim(strtolower($request->get('q', '')));

        $reservations = Reservation::with([
                'user',
                'items.product',
                'items.vendedor.mercadoLocal',
            ])
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    // Búsqueda por ID exacto si es numérico
                    if (ctype_digit($q)) {
                        $qq->orWhere('id', (int) $q);
                    }

                    // Estado
                    $qq->orWhereRaw('LOWER(estado) LIKE ?', ["%{$q}%"]);

                    // Cliente: nombre, apellido, correo (usuario)
                    $qq->orWhereHas('user', function ($u) use ($q) {
                        $u->whereRaw('LOWER(nombre) LIKE ?', ["%{$q}%"])
                          ->orWhereRaw('LOWER(apellido) LIKE ?', ["%{$q}%"])
                          ->orWhereRaw('LOWER(usuario) LIKE ?', ["%{$q}%"]);
                    });

                    // Vendedor: nombre, apellidos, nombre_del_local
                    $qq->orWhereHas('items.vendedor', function ($v) use ($q) {
                        $v->whereRaw('LOWER(nombre) LIKE ?', ["%{$q}%"])
                          ->orWhereRaw('LOWER(apellidos) LIKE ?', ["%{$q}%"])
                          ->orWhereRaw('LOWER(nombre_del_local) LIKE ?', ["%{$q}%"]);
                    });

                    // Área del mercado (mercado_local.nombre)
                    $qq->orWhereHas('items.vendedor.mercadoLocal', function ($m) use ($q) {
                        $m->whereRaw('LOWER(nombre) LIKE ?', ["%{$q}%"]);
                    });
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString(); // conserva ?q= en la paginación

        return view('AdminHistorialPedidos', [
            'reservations' => $reservations,
            'q'            => $q,
        ]);
    }

    /** Ver detalle / gestionar una reserva (Admin) */
    public function show(Reservation $reservation)
    {
        $reservation->load([
            'user',
            'items.product',
            'items.vendedor.mercadoLocal',
        ]);

        // Tu archivo existe como resources/views/AdminEstadoPedidos.blade.php
        return view('AdminEstadoPedidos', compact('reservation'));
    }

    /** Editar: redirige al mismo detalle (gestión) */
    public function edit(Reservation $reservation)
    {
        return redirect()->route('reservations.show', $reservation);
    }

    /** Actualizar estado y/o retiro */
    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'estado' => ['required', Rule::in(['pendiente', 'pagada', 'entregada', 'cancelada'])],
            // si usas retiro textual (tienda/domicilio). Si no lo usas, quítalo del form/blade.
            'retiro' => ['nullable', Rule::in(['tienda', 'domicilio'])],
        ]);

        $reservation->estado = $data['estado'];
        if (array_key_exists('retiro', $data)) {
            $reservation->retiro = $data['retiro'];
        }
        $reservation->save();

        return redirect()
            ->route('reservations.show', $reservation->id)
            ->with('success', 'Reserva actualizada correctamente.');
    }

    /** Eliminar reserva */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reserva eliminada.');
    }

    /** No usados en tu flujo actual */
    public function create() { return abort(404); }
    public function store(Request $r) { return abort(404); }
}
