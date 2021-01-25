<div onclick="handleClose(event)" class="checkout-bg bg-gray-500 bg-opacity-50 z-10 fixed hidden justify-center inset-0 items-center h-screen w-screen ">
    <div onclick="event.stopPropagation()" class="checkout-modal bg-white border rounded-xl p-5 w-64">
        <h1 class="font-bold text-center">Add to Checkout</h1>
        <p class="stock text-gray-400">0 in stock</p>
        <form class="checkout-control" method="post">
            @csrf
            <div class="flex flex-col">
                <input class="id" type="hidden" name="id" value="">
                <input class="block text-center border rounded quantity" required type="number" min="0" step="1" max="" value="{{old('stock') ? old('stock') : 0}}" onkeydown="numbersOnlyKeydown(event)" name="quantity">
                <div class="checkout-button-group text-white flex mt-2 justify-between">
                    <button class="flex-grow-0 block confirm-button border-gray-400 bg-green-400 hover:bg-green-500 px-4 py-2 border rounded-lg" type="submit">Confirm <i class="fa fa-plus"></i></button>
                    <button onclick="handleClose(event)" class="flex-grow-0 block cancel-button border-gray-400 bg-red-400 hover:bg-red-500 px-4 py-2 border rounded-lg">Cancel <i class="fa fa-times"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>