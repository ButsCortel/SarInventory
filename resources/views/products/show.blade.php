<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="flex-1 min-w-0 font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{route('products.index')}}">{{ __('Products') }}</a> <i class="fa fa-angle-right"></i> <span class="inline-block w-5/6 truncate align-top">{{$product->name}}</span>
            </h2>
            <a class="shadow table align-middle flex-shrink-0 ml-auto hover:bg-gray-200 text-center px-2 w-20 border border-gray rounded-full " href="{{route('products.index')}}">Back <i class="fa fa-arrow-left"></i></a>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mx-auto p-6  w-5/6  overflow-hidden shadow-md sm:rounded-lg">

                <div class="lg:flex">
                    <img class="object-contain h-48 w-48 mx-auto" src="{{$product->thumbnail? $product->thumbnail : asset('images/no_image.png')}}" alt="product">

                    <div class="min-w-0 flex-1">
                        <ul class="px-3">
                            <li title="{{$product->name}}" class="truncate text-2xl font-bold">{{$product->name}}</li>
                            <li title="{{$product->category}}" class="truncate ">{{$product->category}}</li>
                            <li class="font-bold truncate">&#8369; {{$product->price}}</li>
                            <li class="{{$product->stock < 1? 'text-red-400': ''}} font-bold truncate">{{$product->stock}} in stock</li>
                            <li title="{{$product->description}}" class="text-xs text-gray-600 rounded-lg p-1 border border-gray-400 h-14 truncate ">{{$product->description}}</li>
                        </ul>
                        <div class="flex justify-around px-2 mt-2">
                            <button onclick="openRestockModal()" class="bg-green-500 text-white rounded-lg border border-gray-400 px-2 py-1">Restock</button>
                            <button onclick="openModal()" class="bg-red-500 text-white rounded-lg border border-gray-400 px-2 py-1">Delete</button>
                        </div>

                    </div>
                    <div id="qrcode" class="rounded-lg border border-gray-400 flex justify-center items-center w-60 mx-auto mt-3 lg:mt-0">
                        <img class="object-contain max-h-48" id="barcode" />
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        JsBarcode("#barcode", "{{$product->code}}", {
            height: 200
        });
    </script>
    @if(Session::has('success_restock'))
    <script>
        showToast("{{session('success_restock')}}", 'success')
    </script>
    @endif
    @if(Session::has('error_restock'))
    <script>
        showToast("{{session('error_restock')}}", 'error')
    </script>
    @endif


    <x-confirm-modal :method="__('DELETE')" :uri="__('products.delete')" :id="__($product->id)" :title="__('Confirm Delete')">
        <p class="font-bold">Are you sure you want to <span class="text-red-500">Delete</span> this product?</p>
    </x-confirm-modal>
    <x-restock-modal :id="__($product->id)">
    </x-restock-modal>

</x-app-layout>