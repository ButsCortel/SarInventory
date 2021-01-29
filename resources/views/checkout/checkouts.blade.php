@foreach($checkouts as $checkout)
<div class="bg-white mx-auto border-gray-300 border mb-4 p-6 flex shadow-md sm:rounded-lg">
    <div class="h-28 w-28">
        <img class="object-contain max-h-full" src="{{$checkout->product->thumbnail}}" alt="product">
    </div>
    <div>
        <p>Product: {{$checkout->product->name}}</p>
        <p>Price: {{$checkout->product->price}}</p>
        <p>Quantity: {{$checkout->quantity}} pc/s</p>
    </div>
</div>
@endforeach