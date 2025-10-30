<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <title>Mi Carrito - Tienda Kelly</title>
  <link rel="shortcut icon" href="{{ asset('images/shop.png') }}" type="image/x-icon">
  <style>
    .fadeInUp{animation:fadeInUp .8s ease forwards}
    @keyframes fadeInUp{0%{opacity:0;transform:translateY(20px)}100%{opacity:1;transform:translateY(0)}}
    .btn-hover:hover{transform:translateY(-3px) scale(1.05);transition:all .3s ease}
    .card-hover:hover{transform:translateY(-5px);box-shadow:0 25px 50px rgba(0,0,0,.15);transition:all .3s ease}
    .payment-container{padding:15px;border:1px solid #e0e0e0;border-radius:12px;margin-top:20px;background:#fefefe;box-shadow:0 2px 4px rgba(0,0,0,.03)}
    .form-input{width:100%;padding:10px;margin-top:5px;margin-bottom:10px;border:1px solid #ccc;border-radius:6px;box-sizing:border-box;transition:border-color .3s}
    .form-input:focus{border-color:#3b82f6;outline:none}
    .hint{font-size:.85rem;color:#6b7280}
    .error{color:#b91c1c;font-size:.9rem;margin-top:4px}
    .disabled-btn{opacity:.6;cursor:not-allowed}
  </style>
</head>

<body class="bg-gradient-to-b from-indigo-50 via-blue-50 to-white flex flex-col min-h-screen">
  @include('components.navbar')

  <!-- BOTÓN FIJO: Seguir comprando -->
  <div class="fixed left-4 top-6 md:top-28 m-4 z-50">
    <div class="relative inline-block">
      <div class="absolute -inset-3 -z-10 rounded-3xl
                  bg-[radial-gradient(120%_120%_at_0%_0%,rgba(147,197,253,0.45)_0%,transparent_60%),radial-gradient(120%_120%_at_100%_100%,rgba(196,181,253,0.45)_0%,transparent_60%)]">
      </div>

      <a href="{{ route('usuarios.index') }}"
         class="group relative inline-flex items-center gap-2 rounded-2xl px-4 py-2 text-sm font-semibold text-black
                bg-white/25 hover:bg-white/30 active:bg-white/35
                backdrop-blur-2xl backdrop-saturate-150
                border border-white/50 ring-1 ring-black/5
                shadow-[inset_0_1px_0_rgba(255,255,255,0.65),0_8px_22px_rgba(0,0,0,0.12)]
                transition-all duration-300 active:scale-[0.98]
                focus:outline-none focus-visible:ring-2 focus-visible:ring-black/20">
        <span class="pointer-events-none absolute inset-0 rounded-2xl
                     before:content-[''] before:absolute before:inset-0 before:rounded-2xl
                     before:bg-gradient-to-b before:from-white/70 before:to-white/15 before:opacity-60
                     after:content-[''] after:absolute after:inset-x-2 after:top-0 after:h-px after:bg-white/80 after:rounded-full"></span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="1.5"
             class="w-5 h-5 shrink-0 text-black/90 transition-transform duration-300 group-hover:-translate-x-0.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
        </svg>
        <span class="relative z-10">Seguir comprando</span>
      </a>
    </div>
  </div>

  <main class="flex-1 max-w-7xl mx-auto p-4 pt-16 md:pt-20 mt-10 fadeInUp">
    <h1 class="text-3xl md:text-5xl font-extrabold text-center mb-12">Mi Carrito</h1>

    @if (session('success'))
      <div class="bg-emerald-600 w-full md:w-1/2 mx-auto text-white font-semibold p-4 rounded mb-6 text-center">
        {{ session('success') }}
      </div>
    @endif

    @if ($cartItems->isEmpty())
      <div class="text-center text-gray-500 text-xl md:text-3xl mt-32">Tu carrito está vacío 😔</div>
    @else
      <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-2 space-y-6">
          @foreach ($cartItems as $cartItem)
            <div class="bg-gradient-to-br from-white to-blue-50 shadow-lg rounded-3xl p-6 flex flex-col md:flex-row items-center gap-6 card-hover fadeInUp">
              <img src="{{ asset('images/' . $cartItem->product->imagen_referencia) }}" alt="{{ $cartItem->product->name }}" class="w-full md:w-44 h-44 object-cover rounded-2xl shadow-md">
              <div class="flex-1">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ $cartItem->product->name }}</h2>
                <p class="text-gray-600 text-lg mb-1">Precio: ${{ $cartItem->product->price }} c/u</p>
                <p class="text-gray-700 text-lg font-semibold">Cantidad: {{ $cartItem->quantity }}</p>
                @if ($cartItem->talla >= 34 || $cartItem->talla == 45)
                  <p class="text-gray-800 font-bold mt-2">Talla: {{ $cartItem->talla }}</p>
                @endif
                <p class="text-gray-800 font-bold mt-2">Subtotal: ${{ $cartItem->product->price * $cartItem->quantity }}</p>
              </div>
              <div>
                <form action="{{ route('usuarios.eliminarcarrito', $cartItem->fk_product) }}" method="POST">
                  @csrf @method('DELETE')
                  <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-8 py-3 rounded-2xl transition btn-hover">Eliminar</button>
                </form>
              </div>
            </div>
          @endforeach
        </div>

        <div class="space-y-6">
          <div class="bg-gradient-to-br from-white to-blue-50 shadow-2xl rounded-3xl p-6 flex flex-col items-center card-hover">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
              Total: <span id="cart-total-display">${{ number_format($total, 2) }}</span>
            </h2>

            <div class="flex flex-col gap-3 w-full mb-6">
              @foreach ($cartItems as $cartItem)
                <div class="flex items-center justify-between bg-white rounded-xl p-2 shadow">
                  <img src="{{ asset('images/' . $cartItem->product->imagen_referencia) }}" alt="{{ $cartItem->product->name }}" class="w-12 h-12 object-cover rounded-md">
                  <div class="flex-1 mx-2">
                    <p class="text-gray-800 font-semibold text-sm">{{ $cartItem->product->name }}</p>
                    <p class="text-gray-600 text-xs">x{{ $cartItem->quantity }}</p>
                  </div>
                  <p class="text-gray-800 font-bold text-sm">${{ $cartItem->product->price * $cartItem->quantity }}</p>
                </div>
              @endforeach
            </div>

            <!-- FORM GUARDAR RESERVA (apartado sin pagar) -->
            <form id="form-reserva-wrapper"
                  action="{{ route('usuarios.reservar') }}"
                  method="POST"
                  class="w-full text-center mb-4"
                  style="display:none;">
              @csrf
              @if ($cartItems->isEmpty() || $total < 5)
                <button type="button" class="w-full bg-gray-400 text-white font-semibold px-8 py-3 rounded-2xl cursor-not-allowed">Guardar Reserva</button>
                @if ($total < 5)
                  <p class="mt-2 text-gray-600 text-center">Pedido mínimo $5 para reservar.</p>
                @endif
              @else
                <button type="submit"
                        id="btn-guardar-reserva"
                        class="w-full bg-gradient-to-r from-green-400 to-emerald-500 hover:from-emerald-500 hover:to-green-400 text-white font-semibold px-8 py-3 rounded-2xl transition btn-hover">
                  Guardar Reserva
                </button>
              @endif
            </form>

            <!-- BLOQUE DE PAGO INMEDIATO -->
            <div class="payment-container w-full" id="payment-container">
              @php $eligible = $total >= 5; @endphp
              <button id="btn-pagar-total" class="w-full btn-hover {{ $eligible ? '' : 'disabled-btn' }}" style="background-color:#10b981;color:white;padding:12px 15px;border:none;border-radius:8px;font-weight:700;font-size:1.1em;" {{ $eligible ? '' : 'disabled' }}>
                Pagar Ahora ${{ number_format($total, 2) }}
              </button>
              @if (!$eligible)
                <p id="mini-restriccion" class="hint mt-2 text-center">Para pagar con tarjeta el total debe ser <b>≥ $5.00</b>.</p>
              @endif

              <div id="formulario-pago-total" style="display:none;margin-top:15px;padding-top:15px;border-top:1px dashed #ddd;">
                <h5 style="font-weight:bold;margin-bottom:10px;color:#374151;">Datos de la Tarjeta</h5>

                <form id="form-tarjeta-total" class="pago-form" novalidate>
                  @csrf
                  <input type="hidden" name="total" value="{{ $total }}">

                  <label class="hint">Nombre Completo en Tarjeta</label>
                  <input type="text" name="card_name" autocomplete="cc-name" placeholder="Nombre Completo" maxlength="40" required class="form-input" />
                  <small class="error" data-error-for="card_name" style="display:none;"></small>

                  <div style="display:flex;align-items:center;gap:8px;margin-top:10px;">
                    <div style="flex:1;">
                      <label class="hint">No. Tarjeta</label>
                      <input type="text" name="card_number" inputmode="numeric" autocomplete="cc-number" placeholder="xxxx xxxx xxxx xxxx" required class="form-input" />
                      <small class="error" data-error-for="card_number" style="display:none;"></small>
                    </div>
                  </div>

                  <div style="display:flex;gap:10px;margin-top:10px;">
                    <div style="flex:1;">
                      <label class="hint">Vencimiento (MM/AA)</label>
                      <input type="text" name="expiry" inputmode="numeric" autocomplete="cc-exp" placeholder="MM/AA" required class="form-input" maxlength="5" />
                      <small class="error" data-error-for="expiry" style="display:none;"></small>
                    </div>
                    <div style="flex:1;">
                      <label class="hint">CVV</label>
                      <input type="text" name="cvv" inputmode="numeric" autocomplete="cc-csc" placeholder="xxx" required class="form-input" maxlength="3" />
                      <small class="error" data-error-for="cvv" style="display:none;"></small>
                    </div>
                  </div>

                  <button type="submit" id="btn-confirmar-pago" class="w-full btn-hover" style="background-color:#059669;color:white;padding:12px 15px;border:none;border-radius:8px;font-weight:700;font-size:1.1em;margin-top:10px;">
                    Confirmar Pago ${{ number_format($total, 2) }}
                  </button>
                  <p class="hint text-center mt-2">El monto mínimo para pagar es de $5.00.</p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </main>

  <footer class="bg-[#292526] pb-16 mt-auto w-full">
    <div class="flex flex-col gap-6 md:gap-0 md:grid grid-cols-3 text-white p-12">
      <div>
        <h2 class="font-bold text-lg">Contact Us</h2>
        <p>Whatsapp: wa.me/50369565421</p>
        <p>Correo: contacto@TiendaKelly.sv</p>
        <p>Dirección: San Rafael Cedros, Cuscatlán</p>
      </div>
      <div>
        <h2 class="font-bold text-lg">Sobre nosotros</h2>
        <p>Apoyamos a los vendedores locales con soluciones tecnológicas.</p>
      </div>
      <div class="md:self-end md:justify-self-end pb-4">
        <p class="font-black text-5xl mb-4">Tienda <span class="text-blue-600">Kelly</span></p>
        <div class="flex gap-2">
          <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full"><img width="18" class="invert" src="{{ asset('images/facebook.png') }}" alt=""></div>
          <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full"><img width="18" class="invert" src="{{ asset('images/google.png') }}" alt=""></div>
          <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full"><img width="18" class="invert" src="{{ asset('images/linkedin.png') }}" alt=""></div>
          <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full"><img width="18" class="invert" src="{{ asset('images/twitter.png') }}" alt=""></div>
          <div class="w-8 aspect-square flex justify-center items-center bg-white rounded-full"><img width="18" src="{{ asset('images/youtube.png') }}" alt=""></div>
        </div>
      </div>
    </div>
  </footer>

  <!-- MODAL -->
  <div id="successModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-2xl p-6 w-11/12 max-w-md relative">
      <button id="closeSuccessModalBtn" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition p-2 rounded-full hover:bg-gray-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
      </button>
      <div class="flex items-center space-x-4 mb-4">
        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <h2 class="text-2xl font-bold text-gray-800">¡Operación Exitosa!</h2>
      </div>
      <p id="modalMessageContent" class="text-gray-600 mb-6 leading-relaxed"></p>
      <div class="flex justify-end"><button id="okBtn" class="px-6 py-2 bg-green-500 text-white font-medium rounded-xl hover:bg-green-600 transition shadow-md">Aceptar</button></div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Modal
      const successModal=document.getElementById('successModal');
      const modalMessageContent=document.getElementById('modalMessageContent');
      const closeSuccessModalBtn=document.getElementById('closeSuccessModalBtn');
      const okBtn=document.getElementById('okBtn');
      const showSuccessModal=(msg)=>{modalMessageContent.textContent=msg;successModal.classList.remove('hidden');};
      const closeSuccessModal=()=>successModal.classList.add('hidden');
      closeSuccessModalBtn?.addEventListener('click',closeSuccessModal);
      okBtn?.addEventListener('click',closeSuccessModal);
      successModal?.addEventListener('click',e=>{if(e.target===successModal)closeSuccessModal();});

      // Pago con tarjeta (flujo inmediato)
      const total=parseFloat('{{ number_format($total, 2, ".", "") }}');
      const eligible=total>=5.0;

      const btnPagarTotal=document.getElementById('btn-pagar-total');
      const formPagoTotal=document.getElementById('formulario-pago-total');
      const formTarjetaTotal=document.getElementById('form-tarjeta-total');
      const paymentContainer=document.getElementById('payment-container');
      const formReservaWrapper=document.getElementById('form-reserva-wrapper');
      const cartTotalDisplay=document.getElementById('cart-total-display');

      btnPagarTotal?.addEventListener('click',()=>{
        if(!eligible) return;
        btnPagarTotal.style.display='none';
        formPagoTotal.style.display='block';
        if(formReservaWrapper) formReservaWrapper.style.display='none';
      });

      if(formTarjetaTotal){
        const nameInput=formTarjetaTotal.querySelector('input[name="card_name"]');
        const numInput =formTarjetaTotal.querySelector('input[name="card_number"]');
        const expInput =formTarjetaTotal.querySelector('input[name="expiry"]');
        const cvvInput =formTarjetaTotal.querySelector('input[name="cvv"]');
        const brandEl  =document.getElementById('card-brand');

        const onlyDigits=s=>(s||'').replace(/\D+/g,'');
        const setError=(field,msg)=>{
          const el=formTarjetaTotal.querySelector(`[data-error-for="${field.getAttribute('name')}"]`);
          if(!el) return;
          if(msg){el.textContent=msg;el.style.display='block';field.setAttribute('aria-invalid','true');}
          else{el.textContent='';el.style.display='none';field.removeAttribute('aria-invalid');}
        };

        function formatCardNumber(raw){
          const digits=onlyDigits(raw).slice(0,16);
          const formatted=digits.replace(/(.{4})/g,'$1 ').trim();
          return {digits,formatted};
        }
        function validateNumber(field){
          const {digits}=formatCardNumber(field.value);
          if(digits.length!==16) return 'El número debe tener exactamente 16 dígitos.';
          return '';
        }

        function formatExpiry(v){
          const d=onlyDigits(v).slice(0,4);
          return (d.length<=2)?d:d.slice(0,2)+'/'+d.slice(2);
        }
        function validateExpiry(field){
          const val=field.value.trim();
          if(!/^\d{2}\/\d{2}$/.test(val)) return 'Usa el formato MM/AA.';
          const [mm,aa]=val.split('/').map(n=>parseInt(n,10));
          if(mm<1||mm>12) return 'Mes inválido.';
          const year=2000+aa;
          const now=new Date();
          const expDate=new Date(year,mm,0,23,59,59);
          if(expDate < new Date(now.getFullYear(),now.getMonth(),now.getDate())) return 'La tarjeta está vencida.';
          return '';
        }

        function validateCVV(field){
          const d=onlyDigits(field.value);
          if(d.length!==3) return 'CVV debe tener 3 dígitos.';
          return '';
        }

        numInput.addEventListener('input',()=>{
          const {formatted}=formatCardNumber(numInput.value);
          numInput.value=formatted;
          if(brandEl) brandEl.textContent='16';
          setError(numInput,'');
        });
        numInput.addEventListener('blur',()=>setError(numInput,validateNumber(numInput)));

        expInput.addEventListener('input',()=>{expInput.value=formatExpiry(expInput.value);setError(expInput,'');});
        expInput.addEventListener('blur',()=>setError(expInput,validateExpiry(expInput)));

        cvvInput.addEventListener('input',()=>{cvvInput.value=onlyDigits(cvvInput.value).slice(0,3);setError(cvvInput,'');});
        cvvInput.addEventListener('blur',()=>setError(cvvInput,validateCVV(cvvInput)));

        nameInput.addEventListener('input',()=>{
          nameInput.value=nameInput.value.replace(/[0-9_<>]/g,'').replace(/\s{2,}/g,' ').slice(0,40);
          setError(nameInput,'');
        });

        formTarjetaTotal.addEventListener('submit',(e)=>{
          if(!eligible){
            e.preventDefault();
            alert('El total debe ser al menos $5.00 para realizar el pago.');
            return;
          }
          const errors=[];
          if(!nameInput.value.trim()) errors.push([nameInput,'Ingresa el nombre como aparece en la tarjeta.']);
          const nErr=validateNumber(numInput); if(nErr) errors.push([numInput,nErr]);
          const eErr=validateExpiry(expInput); if(eErr) errors.push([expInput,eErr]);
          const cErr=validateCVV(cvvInput);   if(cErr) errors.push([cvvInput,cErr]);

          ['card_name','card_number','expiry','cvv'].forEach(n=>{
            const f=formTarjetaTotal.querySelector(`[name="${n}"]`); setError(f,'');
          });

          if(errors.length){
            e.preventDefault();
            errors.forEach(([f,msg])=>setError(f,msg));
            errors[0][0].focus();
            return;
          }

          // Simulación de pago exitoso (front)
          e.preventDefault();
          formPagoTotal.style.display='none';
          const totalMonto=cartTotalDisplay?cartTotalDisplay.textContent:'$XX.XX';
          showSuccessModal(`¡Pago de ${totalMonto} exitoso! Tu compra ha sido confirmada y se está procesando.`);
          if(paymentContainer){
            paymentContainer.innerHTML='<div style="text-align:center;background-color:#d1fae5;color:#065f46;padding:15px;border-radius:8px;font-weight:bold;">¡Pago Completado! Gracias por tu compra.</div>';
          }
          if(formReservaWrapper) formReservaWrapper.style.display='block';
        });
      }
    });
  </script>

</body>
</html>
