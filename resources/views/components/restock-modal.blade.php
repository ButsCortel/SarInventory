<div onclick="closeModal()" class="restock-modal hidden checkout-bg bg-gray-500 bg-opacity-50 z-10 fixed justify-center inset-0 items-center h-screen w-screen">
    <div onclick="event.stopPropagation()" class="checkout-modal bg-white border rounded-xl p-5 w-64">
        <h5 class="text-gray-400 modal-title">Restock</h5>
        <div class="modal-body">
            Enter quantity
        </div>
        <form action="{{route('products.restock', $id)}}" method="POST">
            @method('PUT')
            @csrf
            <input oninput="numbersOnlyInput(event)" onkeydown="numbersOnlyKeydown(event)" required class="block w-full rounded {{$errors->has('stock') ? 'border-red-500' : ''}}" type="number" min="1" value="{{old('stock') ? old('stock') : 1}}" name="stock" id="stock">
            <div class="modal-footer flex justify-between mt-2">
                <button class="hover:bg-green-700 bg-green-500 text-white py-1 px-3 rounded-xl" type="submit">Confirm</button>
                <button onclick="closeModal(event)" type="button" class="hover:bg-gray-700 bg-gray-500 text-white py-1 px-3 rounded-xl" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>