<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="p-5 checkout-index">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex h-full">
            <div class="mx-auto">
                <div class="w-48 h-48 bg-gray-400 border border-black rounded-lg"></div>
                <button class="block bg-white hover:bg-gray-200 mx-auto mt-3 p-2 rounded-lg border border-gray-400">Camera</button>
                <div class="my-4 text-white ">
                    <button class="font-bold bg-green-400 hover:bg-green-500 w-full block mx-auto p-2 rounded-lg border border-gray-400 my-2">Checkout All</button>
                    <button class="font-bold bg-red-400 hover:bg-red-500 w-full block mx-auto p-2 rounded-lg border border-gray-400 my-2">Reset</button>
                </div>
            </div>
            <div class="flex-grow h-full overflow-y-auto px-4">
                @foreach($checkouts as $checkout)

                <div class="bg-white mx-auto mb-4 p-6 flex shadow-md sm:rounded-lg">
                    <div class="h-28 w-28">
                        <img class="object-contain max-h-full" src="{{$checkout->product->thumbnail}}" alt="product">
                    </div>
                    <div>
                        <p>Product: {{$checkout->product->name}}</p>
                        <p>Price: {{$checkout->product->price}}</p>
                        <p>Quantity: {{$checkout->quantity}} pc/s</p>
                    </div>

                    <!-- <p>Quantity:{{$checkout->quantity}}</p> -->
                </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>