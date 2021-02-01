<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="p-5 checkout-index">
        <div class="lg:max-w-7xl max-w-6xl mx-auto sm:px-6 lg:px-8 lg:flex justify-between h-full ">
            <div class="mx-auto">
                <button onclick="toggleCamera()" class="block bg-white hover:bg-gray-200 mx-auto mt-1 px-2 py-1 rounded-lg border border-gray-400">Toggle Camera</button>
                <div class="mx-auto border bg-black  w-52 h-44 my-1 flex justify-center items-center">
                    <video class="object-contain" id="video"></video>
                </div>
                <form class="add-checkout">
                    <div class="flex flex-col py-1">
                        <input required type="text" id="code" class="text-center border border-gray-400 rounded-lg m-w-0 flex-1 code" name="code" placeholder="input barcode">
                        <div class='flex items-center'>
                            <label class="flex-1 min-w-0 text-center" for="quantity">Quantity:</label>
                            <input name="quantity" id="quantity" class="flex-1 min-w-0 text-center border rounded-lg my-1 quantity" required type="number" min="1" step="1" max="" value="1" onkeydown="numbersOnlyKeydown(event)">
                        </div>
                        <button class="hover:bg-gray-200 py-1  border border-gray-400 rounded-lg bg-white">Add to Checkout <i class="fa fa-plus"></i></button>

                    </div>

                </form>

            </div>
            <div class="checkouts-section border border-gray-200 shadow-md flex-1 my-2 lg:my-0 mx-2 rounded-lg bg-white p-2  flex-grow lg:h-full overflow-y-auto px-4">
                @include('checkout.checkouts')
            </div>
            <div class="total-section shadow-md sm:rounded-lg border border-gray-200 bg-white flex-1 checkouts-total lg:h-full px-4">
                @include('checkout.total')
            </div>

        </div>
    </div>
</x-app-layout>