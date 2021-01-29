<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="p-5 checkout-index">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex h-full">
            <div class="mx-auto">
                <button onclick="toggleCamera()" class="block bg-white hover:bg-gray-200 mx-auto mt-1 px-2 py-1 rounded-lg border border-gray-400">Toggle Camera</button>
                <div class="mx-auto border bg-black  w-52 h-44 my-1 flex justify-center items-center">
                    <video class="object-contain" id="video"></video>
                </div>
                <form class="add-checkout">
                    <div class="flex flex-col py-1">
                        <input required type="text" id="code" class="text-center border border-gray-400 rounded-lg m-w-0 flex-1 code" name="code" placeholder="input barcode">
                        <label for="quantity">Quantity:</label>
                        <input name="quantity" id="quantity" class="block text-center border rounded-lg my-1 quantity" required type="number" min="1" step="1" max="" value="1" onkeydown="numbersOnlyKeydown(event)">
                        <button class="w-full hover:bg-gray-200 py-1  border border-gray-400 rounded-lg bg-white">Add to Checkout <i class="fa fa-plus"></i></button>

                    </div>

                </form>

            </div>
            <div class="mx-2 rounded-lg bg-white p-2 checkouts-section flex-grow h-full overflow-y-auto px-4">
                @include('checkout.checkouts')
            </div>
            <div class="checkouts-total h-full px-4">
                @include('checkout.total')
            </div>

        </div>
    </div>
</x-app-layout>