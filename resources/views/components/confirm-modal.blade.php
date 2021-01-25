<div onclick="closeModal()" class="confirm-modal hidden checkout-bg bg-gray-500 bg-opacity-50 z-10 fixed flex justify-center inset-0 items-center h-screen w-screen">
    <div onclick="event.stopPropagation()" class="checkout-modal bg-white border rounded-xl p-5 w-64">
        <h5 class="text-gray-400 modal-title">{{$title}}</h5>
        <div class="modal-body">
            {{$slot}}
        </div>
        <div class="modal-footer flex justify-between mt-2">

            <form action="{{route($uri, $id)}}" method="{{$method != ''? 'POST' : ''}}">

                @if($method != '' && $method != 'POST')
                @method($method)
                @endif
                @csrf
                <button class="hover:bg-green-700 bg-green-500 text-white py-1 px-3 rounded-xl" type="submit">Confirm</button>
            </form>
            <button onclick="closeModal(event)" type="button" class="hover:bg-gray-700 bg-gray-500 text-white py-1 px-3 rounded-xl" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>