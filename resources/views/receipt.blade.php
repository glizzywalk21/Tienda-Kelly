<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recibo de Compra</title>
  <style>
    /* ===== Estilos base (sin Tailwind, sin imágenes) ===== */
    :root {
      --indigo-100: #e0e7ff; /* from-indigo-100 */
      --blue-100:   #dbeafe; /* via-blue-100 */
      --indigo-600: #4f46e5; /* text-indigo-600 */
      --ink:        #111827; /* gray-900 */
      --muted:      #6b7280; /* gray-500/600 */
      --border:     #e5e7eb; /* gray-200 */
      --bg-card:    #ffffff;
    }
    * { box-sizing: border-box; }
    html, body { height: 100%; }
    body {
      margin: 0; padding: 24px; color: var(--ink);
      background: linear-gradient(135deg, var(--indigo-100), var(--blue-100) 45%, #ffffff 100%);
      font-family: Arial, Helvetica, sans-serif;
    }
    .receipt {
      max-width: 900px; margin: 0 auto; background: var(--bg-card);
      border: 1px solid var(--border); border-radius: 12px; padding: 24px;
    }
    .header { text-align: center; margin-bottom: 16px; }
    .title { font-size: 28px; font-weight: 800; letter-spacing: .3px; margin: 0; }
    .title .accent { color: var(--indigo-600); }
    .subtitle { text-transform: uppercase; font-size: 12px; color: var(--muted); margin: 4px 0 0; letter-spacing: .8px; }
    .bar { height: 4px; background: #c7d2fe; border-radius: 999px; width: 120px; margin: 12px auto 0; }

    .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px; }

    /* === CAMBIO CLAVE: etiquetas en negro, negrita y EN LA MISMA LÍNEA que el valor === */
    .field .label { display: inline; font-size: 12px; color: #000000; font-weight: 800; margin-right: 6px; }
    .field .value { display: inline; font-size: 14px; color: var(--ink); }

    .hr { height: 1px; background: var(--border); border: 0; margin: 16px 0; }

    /* Encabezados de secciones en negro y negrita */
    h2 { margin: 10px 0; font-size: 18px; color: #000000; font-weight: 800; }
    h3 { margin: 10px 0 6px; font-size: 16px; color: #000000; font-weight: 800; }
    .meta { font-size: 12px; color: var(--muted); }

    .table { width: 100%; border-collapse: collapse; margin-top: 6px; }
    .table th, .table td { border: 1px solid var(--border); padding: 8px; text-align: left; font-size: 13px; }
    .table thead th { background: #f9fafb; font-weight: 800; color: #000000; } /* negro + bold */
    .table tbody tr:nth-child(even) { background: #f8fafc; }
    .table tfoot td { color: #000000; font-weight: 800; } /* totales en negro + bold */
    .text-right { text-align: right; }
    .total-row { background: #eef2ff; }
    .total-strong { font-weight: 800; }

    .section { margin: 18px 0; }
    .totals { margin-top: 16px; }

    /* Tip: los generadores PDF a veces ignoran gradientes. Si eso ocurre, el fondo se verá blanco. */
    @media print { body { background: #ffffff !important; } }
  </style>
</head>
<body>
  <div class="receipt">
    <!-- Encabezado -->
    <div class="header">
      <h1 class="title">Tienda <span class="accent">Kelly</span></h1>
      <p class="subtitle">Recibo de Compra</p>
      <div class="bar"></div>
    </div>

    <!-- Datos del comprador -->
    <div class="grid">
      <div class="field">
        <span class="label">Nombre completo del comprador:</span>
        <span class="value">{{ $reservation->user->nombre }} {{ $reservation->user->apellido }}</span>
      </div>
      <div class="field">
        <span class="label">Email:</span>
        <span class="value">{{ $reservation->user->usuario }}</span>
      </div>
      <div class="field">
        <span class="label">Fecha del recibo:</span>
        <span class="value">{{ now()->format('d/m/Y H:i') }}</span>
      </div>
    </div>

    <hr class="hr" />

    <!-- Mercados / Vendedores / Items -->
    @if ($mercados->isEmpty())
      <p>No hay mercados disponibles.</p>
    @else
      @foreach ($mercados as $mercado)
        <div class="section">
          <h2>Mercado local: {{ $mercado->nombre }}</h2>
          @php
            $vendedores = $reservation->items
              ->filter(function ($item) use ($mercado) {
                return optional(optional($item->product)->vendedor)->mercadoLocal->id === $mercado->id;
              })
              ->map(function ($item) { return $item->product->vendedor; })
              ->unique('id')
              ->values();
          @endphp

          @forelse ($vendedores as $vendedor)
            <div class="section">
              <h3>Vendedor: {{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h3>
              <div class="meta">Puesto #{{ $vendedor->numero_puesto }} — {{ $vendedor->mercadoLocal->nombre }} ({{ $vendedor->mercadoLocal->ubicacion }})</div>

              <table class="table">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th class="text-right">Precio</th>
                    <th class="text-right">Cantidad</th>
                    <th class="text-right">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @php $totalVendedor = 0; @endphp
                  @foreach ($reservation->items->where('product.vendedor.id', $vendedor->id)->where('product.vendedor.mercadoLocal.id', $mercado->id) as $item)
                    <tr>
                      <td>{{ $item->product->name }}</td>
                      <td class="text-right">${{ number_format($item->precio, 2) }}</td>
                      <td class="text-right">{{ $item->quantity }}</td>
                      <td class="text-right">${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @php $totalVendedor += $item->subtotal; @endphp
                  @endforeach
                </tbody>
                <tfoot>
                  <tr class="total-row">
                    <td colspan="3" class="text-right">Total vendedor:</td>
                    <td class="text-right total-strong">${{ number_format($totalVendedor, 2) }}</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          @empty
            <p class="meta">No hay vendedores con productos de este mercado en la reserva.</p>
          @endforelse
        </div>
      @endforeach
    @endif

    <!-- Total general -->
    <div class="totals">
      <table class="table">
        <tfoot>
          <tr class="total-row">
            <td class="text-right" colspan="3">Total general:</td>
            <td class="text-right total-strong">${{ number_format($reservation->total, 2) }}</td>
          </tr>
        </tfoot>
      </table>
    </div>

    <p class="meta" style="margin-top:10px;">Gracias por su compra.</p>
  </div>
</body>
</html>