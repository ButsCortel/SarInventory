<x-app-layout>
    <x-slot name="header">

        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}

            </h2>
            <div class="flex ml-auto">
                <a class="flex-grow mr-2 bg-white hover:bg-gray-200 text-center shadow px-2 border border-gray rounded-xl block" href="{{route('products.showaddstock')}}">Restock <i class="fa fa-refresh"></i></a>
                <a class="flex-grow bg-white hover:bg-gray-200 text-center shadow px-2 border border-gray rounded-xl block" href="{{route('products.add')}}">Add Product <i class="fa fa-plus"></i></a>
            </div>
        </div>
    </x-slot>


    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($products as $product)
            <div onclick="window.location=`{{url('/products').'/'.$product->id}}`" class="w-full border hover:border-gray-400 hover:bg-gray-50 cursor-pointer shadow-md bg-white p-6 rounded-lg">
                <img class="object-contain h-48 mx-auto" src="{{$product->thumbnail? $product->thumbnail : asset('images/no_image.png')}}" alt="product">
                <ul class="w-full">
                    <li class="truncate font-bold">{{$product->name}}</li>
                    <li class="truncate text-sm {{$product->description? '' : 'text-gray-500'}}">{{$product->description? $product->description : 'No description.'}}</li>
                    <li class="truncate text-sm">{{$product->category}}</li>
                    <li class="truncate">&#8369; {{$product->price}}</li>
                    <li class="truncate font-bold {{$product->stock == 0 ? 'text-red-500' : 'text-green-500'}}">{{$product->stock}} in stock</li>
                </ul>
                <div class=" flex justify-center align-middle">
                    <button onclick="handleCheckout(event, '{{$product->stock}}', '{{$product->id}}')" {{$product->stock > 0? '': 'disabled'}} class="{{$product->stock? '': 'opacity-50'}} checkout-button block py-2 px-10 border-gray-400 hover:bg-gray-200 px-4 border rounded-xl">Checkout <i class="fa fa-plus"></i></button>
                </div>


            </div>

            @endforeach
        </div>
    </div>
    @if(Session::has('success_delete'))
    <script>
        showToast("{{session('success_delete')}}", 'success')
    </script>
    @endif
    @if(Session::has('success_create'))
    <script>
        showToast("{{session('success_create')}}", 'success')
    </script>
    @endif
</x-app-layout>