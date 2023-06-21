<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product - ')  }} {{ $product->name }}
        </h2>
    </x-slot>

<div class="py-12">
  <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6">
         <div class="px-2 sm:px-0">
    <h3 class="text-base font-semibold leading-7 text-gray-900">Confirm Purchase</h3>
    
  </div>
  <div class="mt-2 border-t border-gray-100">
    <dl class="divide-y divide-gray-100">
      <div class="px-12 py-2 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-0">
        <dt class="text-sm font-medium leading-6 text-gray-900">You about to purchase  {{ $product->name }} for $ {{ $product->price }}</dt>
       
      </div>
  
    </dl>
  </div>
      </div>
      <div class="p-6 border-t border-gray-100">
         <form method="POST" action="{{ route('confirm') }}">
        @csrf

        <!-- Name -->
        <div>
          <input type="hidden" name="product_slug" value="{{ $product->slug }}">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" : value="{{ auth()->user()->name }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" : value="{{ auth()->user()->email }}" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />

            <x-text-input id="address" class="block mt-1 w-full"
                            type="text" :value="old('email')"
                            name="address"
                            required />

            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

     

        <div class="flex items-center justify-start mt-4">

            <x-primary-button class="ml-4">
                {{ __('Confirm Purchase') }}
            </x-primary-button>
        </div>
    </form>
      </div>
    </div>
  </div>
</div>
</x-app-layout>
