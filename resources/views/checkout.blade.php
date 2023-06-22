<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-4 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    {{ __("You're in Checkout Page!") }}
                </div>
                <div class="p-4 text-gray-900">
                         <form method="POST" action="{{ route('pay') }}" id="payment-form">
        @csrf
        <input type="hidden" name="payment_method" id="payment-method" value="">
        <input type="hidden" name="order_id"  value="{{ $order->id }}">
        <div class="my-input" id="card-element"></div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-8" id="payment-button" type="button">PAY $ {{ $order->product->price }}</button>
    </form>
    </div>
    @if(session('error'))
    <div class="alert alert-danger mt-4">
        
        <strong>{{ session('error') }}</strong>
    </div>
    @endif
    
    <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md " role="alert">
  <div class="flex">
    <div class="py-1">
      <svg class="fill-current h-6 w-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M2.003 13.805c.04.535.472.95 1.003.95h13.988c.53 0 .963-.415 1.003-.95l.6-8.013c.04-.536-.353-.992-.888-1.033-.535-.04-.992.353-1.032.888l-.6 8.013c-.04.536.353.992.888 1.033h-1.064c.027.17.042.344.042.525 0 2.209-1.791 4-4 4s-4-1.791-4-4c0-.181.015-.355.042-.525h-1.064c.535-.04.928-.497.888-1.033l-.6-8.013c-.04-.535-.497-.928-1.032-.888-.536.04-.928.497-.888 1.033l.6 8.013zm10.724-10.019c-.277-.186-.664-.186-.942 0l-6.34 4.227c-.356.237-.565.653-.565 1.093v2.39c0 .44.209.856.565 1.093l6.34 4.227c.277.186.664.186.942 0l6.34-4.227c.356-.237.565-.653.565-1.093v-2.39c0-.44-.209-.856-.565-1.093l-6.34-4.227z"/>
      </svg>
    </div>
    <div>
      <p class="text-sm  Cnone"  id="card-error" id="card-error"></p>
    </div>
  </div>
</div> 
            </div>
        </div>

           
    </div>

    @push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script
  src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
   var stripe = Stripe('{{ config('services.stripe.publishable_key') }}'); 
   var elements = stripe.elements();
   var cardElement = elements.create('card');
 
     cardElement.mount('#card-element');
 
     $('#payment-button').on('click', function() {

        $('#payment-button').attr('disabled',true);

        stripe
  .confirmCardSetup('{{ $paymentIntent->client_secret }}', {
    payment_method: {
      card: cardElement,
    },
  })
  .then(function(result) {
        if(result.error){
           $('#card-error').text(result.error.message).removeClass('Cnone');
           $('#payment-button').attr('disabled',false);
        }else{
            // console.log(result);
            $('#payment-method').val(result.setupIntent.payment_method);
            $('#payment-form').submit();
        }
  });
     });


</script>

@endpush
@push('css')
<style>
  .my-input {
    padding: 10px;
    border: 1px solid #ccc;
  }
</style>

@endpush
</x-app-layout>


