<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

<div class="py-12">
  <div class="max-w-2xl mx-auto sm:px-3 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 w-11/12 mx-auto">
        <table class="table w-full pr-0">
          <thead>
            <tr>
              <th class="bg-gray-100 ">Product</th>
              <th class="bg-gray-100">Price</th>
              <th class="bg-gray-100"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <td class="my-1">{{ $product->name }}</td>
              <td class="my-1">$ {{ $product->price }}</td>
              <td class="my-1"><a href="{{ route('confirm-buy',['slug' => $product->slug]) }}" class="rounded-none ...">Buy</a></td>
            </tr>
           @endforeach 
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</x-app-layout>
