<div>
<div class="flex justify-end px-6">
        <span>ID: <span class="font-semibold text-gray-400">{{ session('code') }}</span></span>
    </div>
<div class="p-4 mb-4" id="card"></div>

<div class="flex justify-end mb-4">

<span class="font-bold text-lg">Total: {{ $tramite->total }} Bs.</span>

</div>


<button id="button-pay" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold uppercase rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">siguiente</button>
<div wire:loading>
        Procesando Pago...
    </div>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>

<script>
    let stripe = Stripe(`pk_test_51Kfa3lCfO3YICm7hTtVL7iFGYMz9oJmgXcVJGMBXNwnSeLmNhHJKOqAfNhRnpatR0czWbLFLNJWJd2wqk23sm7Up00N1ZQTiXw`),
    elements = stripe.elements(),
    card = undefined;

    if (!card) {
            card = elements.create('card', {
                hidePostalCode: true,

            });
        }
    card.mount(document.getElementById('card'));

    function purchase(){
    stripe.createToken(card).then((result) => {
        Livewire.emit('token' , result)
    });
  }

  document.getElementById('button-pay').onclick = function(e){
   purchase()
}


</script>

@endpush