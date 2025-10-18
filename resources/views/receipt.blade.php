<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Recibo de Compra</title>
  <style>
    :root {
      --indigo-100:#e0e7ff; --blue-100:#dbeafe; --indigo-600:#4f46e5;
      --ink:#111827; --muted:#6b7280; --border:#e5e7eb; --bg:#ffffff;
    }
    *{ box-sizing:border-box; }
    html,body{ height:100%; }
    body{
      margin:0; padding:24px; color:var(--ink);
      background:linear-gradient(135deg,var(--indigo-100),var(--blue-100) 45%,#ffffff 100%);
      font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
      font-size: 12px;
    }
    .receipt{ max-width:900px; margin:0 auto; background:var(--bg); border:1px solid var(--border); border-radius:12px; padding:24px; }
    .header{ text-align:center; margin-bottom:16px; }
    .title{ font-size:28px; font-weight:800; margin:0; }
    .title .accent{ color:var(--indigo-600); }
    .subtitle{ text-transform:uppercase; font-size:12px; color:var(--muted); margin:4px 0 0; letter-spacing:.8px; }
    .bar{ height:4px; background:#c7d2fe; border-radius:999px; width:120px; margin:12px auto 0; }

    .grid{ display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px; }
    .field .label{ display:inline; font-size:12px; color:#000; font-weight:800; margin-right:6px; }
    .field .value{ display:inline; font-size:14px; color:var(--ink); }

    .hr{ height:1px; background:var(--border); border:0; margin:16px 0; }
    h2{ margin:10px 0; font-size:18px; color:#000; font-weight:800; }
    h3{ margin:10px 0 6px; font-size:16px; color:#000; font-weight:800; }
    .meta{ font-size:12px; color:var(--muted); }

    table{ width:100%; border-collapse:collapse; margin-top:6px; }
    th,td{ border:1px solid var(--border); padding:8px; text-align:left; font-size:13px; }
    thead th{ background:#f9fafb; font-weight:800; color:#000; }
    tbody tr:nth-child(even){ background:#f8fafc; }
    tfoot td{ color:#000; font-weight:800; }
    .right{ text-align:right; }
    .total-row{ background:#eef2ff; }
  </style>
</head>
<body>
  <div class="receipt">
    <div class="header">
      <h1 class="title">Tienda <span class="accent">Kelly</span></h1>
      <p class="subtitle">Recibo de Compra</p>
      <div class="bar"></div>
    </div>

    <div class="grid">
      <div class="field">
        <span class="label">Nombre completo del comprador:</span>
        <span class="value">{{ ($reservation->user->nombre ?? '') }} {{ ($reservation->user->apellido ?? '') }}</span>
      </div>
      <div class="field">
        <span class="label">Email:</span>
        <span class="value">{{ $reservation->user->usuario ?? '—' }}</span>
      </div>
      <div class="field">
        <span class="label">Fecha del recibo:</span>
        <span class="value">{{ optional(now())->format('d/m/Y H:i') }}</span>
      </div>
      <div class="field">
        <span class="label">Estado:</span>
        <span class="value">{{ ucfirst($reservation->estado ?? 'pendiente') }}</span>
      </div>
    </div>

    <hr class="hr" />

    @if (($mercados ?? collect())->isEmpty())
      <p class="meta">No hay mercados disponibles para esta reserva.</p>
    @else
      @foreach ($mercados as $mercado)
        <div>
          <h2>Mercado local: {{ $mercado->nombre }}</h2>

          @php
            // Vendedores únicos del mercado actual dentro de la reserva
            $vendedores = $reservation->items
              ->filter(function ($item) use ($mercado) {
                  return optional(optional($item->product)->vendedor)->mercadoLocal
                         && optional($item->product->vendedor->mercadoLocal)->id === $mercado->id;
              })
              ->map(function ($item) { return $item->product->vendedor; })
              ->unique('id')
              ->values();
          @endphp

          @forelse ($vendedores as $vendedor)
            <div>
              <h3>Vendedor: {{ $vendedor->nombre }} {{ $vendedor->apellidos }}</h3>
              <div class="meta">Puesto #{{ $vendedor->numero_puesto }} — {{ $vendedor->mercadoLocal->nombre }} {{ $vendedor->mercadoLocal->ubicacion ? '(' . $vendedor->mercadoLocal->ubicacion . ')' : '' }}</div>

              <table>
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th class="right">Precio</th>
                    <th class="right">Cantidad</th>
                    <th class="right">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @php $totalVendedor = 0; @endphp
                  @foreach ($reservation->items->where('product.vendedor.id', $vendedor->id)->where('product.vendedor.mercadoLocal.id', $mercado->id) as $item)
                    @php
                      $prodName = $item->product->nombre ?? $item->product->name ?? $item->nombre ?? '—';
                    @endphp
                    <tr>
                      <td>{{ $prodName }}</td>
                      <td class="right">${{ number_format($item->precio ?? 0, 2) }}</td>
                      <td class="right">{{ $item->quantity }}</td>
                      <td class="right">${{ number_format($item->subtotal ?? 0, 2) }}</td>
                    </tr>
                    @php $totalVendedor += ($item->subtotal ?? 0); @endphp
                  @endforeach
                </tbody>
                <tfoot>
                  <tr class="total-row">
                    <td colspan="3" class="right">Total vendedor:</td>
                    <td class="right">${{ number_format($totalVendedor, 2) }}</td>
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

    <table style="margin-top:12px;">
      <tfoot>
        <tr class="total-row">
          <td class="right" colspan="3">Total general:</td>
          <td class="right">${{ number_format($reservation->total ?? 0, 2) }}</td>
        </tr>
      </tfoot>
    </table>

    <p class="meta" style="margin-top:10px;">Gracias por su compra.</p>
  </div>
</body>
</html>
