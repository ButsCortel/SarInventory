@foreach($checkouts as $checkout)
<div class="bg-white mx-auto border-gray-300 border mb-4 p-6 md:flex shadow-md sm:rounded-lg">
    <div class="px-2 flex-shrink-0 flex-grow w-full h-28 md:w-28 flex items-center justify-center mx-auto">
        <img class="object-contain max-h-full" src="{{$checkout->product->thumbnail ?? asset('images/no_image.png')}}" alt="product">
    </div>
    <div class="flex-grow min-w-0">
        <p class="truncate w-full">Product: {{$checkout->product->name}}</p>
        <p class="truncate w-full">Price: &#8369;{{$checkout->product->price}}</p>
        <p class="truncate w-full">Quantity: {{$checkout->quantity}} pc/s</p>
        <div class="flex justify-end text-white">
            <button title="view product" onclick="window.location=`{{url('/products').'/'.$checkout->product->id}}`" class="bg-gray-500 hover:bg-gray-700  border rounded-lg px-2 py-1 mx-1"><i class="fa fa-eye"></i></button>
            <button onclick="deleteCheckout('{{$checkout->product->id}}')" title="remove" class="remove-btn bg-red-500  hover:bg-red-700  border rounded-lg px-2 py-1 mx-1"><i class="fa fa-minus" aria-hidden="true"></i>

            </button>
        </div>
    </div>
</div>
@endforeach