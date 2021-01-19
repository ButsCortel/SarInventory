<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}

            </h2>
            <a class="hover:bg-gray-200 text-center px-2 border border-gray rounded-full block" href="{{route('products.add')}}">Add a Product <i class="fa fa-plus"></i></a>
        </div>

    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($products as $product)
            <div onclick="window.location=`{{url('/products').'/'.$product->id}}`" class="w-full border hover:border-gray-400 hover:bg-gray-50 cursor-pointer bg-white p-6 rounded-lg">
                <img class="object-contain h-48 mx-auto" src="{{$product->thumbnail? $product->thumbnail : asset('images/no_image.png')}}" onerror="" alt="product">
                <ul class="w-full">
                    <li class="truncate font-bold">{{$product->name}}</li>
                    <li class="truncate text-sm {{$product->description? '' : 'text-gray-500'}}">{{$product->description? $product->description : 'No description.'}}</li>
                    <li class="truncate text-sm">{{$product->category}}</li>
                    <li class="truncate">&#8369; {{$product->price}}</li>
                    <li class="truncate font-bold {{$product->stock == 0 ? 'text-red-500' : 'text-green-500'}}">{{$product->stock}} in stock</li>
                </ul>
                <form class="checkout-control">
                    <div onclick='event.stopPropagation()' class="flex justify-between">

                        <input class="text-center border rounded flex-grow quantity" required type="number" min="0" step="1" max="{{$product->stock}}" value="{{old('stock') ? old('stock') : 0}}" onkeydown="numbersOnlyKeydown(event)" name="quantity">
                        <button class="flex-grow flex-shrink-0 checkout-button border-gray-400 hover:bg-gray-200 px-4 border rounded-lg" type="submit">Checkout <i class="fa fa-plus"></i></button>
                    </div>

                </form>
            </div>

            @endforeach
        </div>
    </div>
</x-app-layout>