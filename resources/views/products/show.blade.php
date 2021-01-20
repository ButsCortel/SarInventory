<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="flex-1 min-w-0 font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{route('products.index')}}">{{ __('Products') }}</a> <i class="fa fa-angle-right"></i> <span class="inline-block w-5/6 truncate align-top">{{$product->name}}</span>
            </h2>
            <a class="table align-middle flex-shrink-0 ml-auto hover:bg-gray-200 text-center px-2 w-20 border border-gray rounded-full " href="{{route('products.index')}}">Back <i class="fa fa-arrow-left"></i></a>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mx-auto p-6  w-5/6  overflow-hidden shadow-md sm:rounded-lg">

                <div class="lg:flex">
                    <img class="object-contain h-48 mx-auto" src="{{asset('images/no_image.png')}}" alt="product">

                    <div class="min-w-0 flex-1">
                        <ul class="px-3">
                            <li title="{{$product->name}}" class="truncate text-2xl font-bold">{{$product->name}}</li>
                            <li title="{{$product->category}}" class="truncate ">{{$product->category}}</li>
                            <li class="font-bold truncate">&#8369; {{$product->price}}</li>
                            <li class="font-bold truncate">{{$product->stock}} in stock</li>
                            <li title="{{$product->description}}" class="rounded-lg p-1 border border-gray-400 h-14 truncate ">{{$product->description}}</li>
                        </ul>
                        <div class="flex justify-around  lg:justify-end px-2 mt-2">
                            <button class="lg:mr-2 bg-blue-500 text-white rounded-lg border border-gray-400 px-2 py-1">Update</button>
                            <button class="bg-red-500 text-white rounded-lg border border-gray-400 px-2 py-1">Delete</button>
                        </div>

                    </div>
                    <div id="qrcode" class="h-48 w-48 mx-auto mt-3 lg:mt-0"></div>

                </div>

            </div>
        </div>
    </div>
    <script>
        new QRCode(document.getElementById("qrcode"), {
            width: 200,
            height: 200,
        }).makeCode("{{$product->code}}");
    </script>

</x-app-layout>