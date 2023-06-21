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
                         <form method="POST" action="{{ route('pay') }}">
        @csrf
        <div class="my-input" id="card-element"></div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-8" type="submit">PAY $ {{ $order->product->price }}</button>
    </form>
    </div>
            </div>
        </div>

           
    </div>

    @push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
   var stripe = Stripe('{{ config('services.stripe.publishable_key') }}'); 
   var elements = stripe.elements();
   var cardElement = elements.create('card');
     cardElement.mount('#card-element');

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


