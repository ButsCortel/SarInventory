<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{route('products.index')}}">{{ __('Products') }}</a> <i class="fa fa-angle-right"></i> Restock
            </h2>
            <a class="shadow table align-middle flex-shrink-0 ml-auto hover:bg-gray-200 text-center px-2 w-20 border border-gray rounded-full" href="{{route('products.index')}}">Back <i class="fa fa-arrow-left"></i></a>

        </div>

    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mx-auto lg:flex px-5  py-4 sm:w-4/6  overflow-hidden shadow-md sm:rounded-lg">
                <!-- <div onclick="" class="cursor-pointer relative flex justify-center items-center">
                    <video class="bg-black h-72 w-80" id="video"></video>
                    <p class="font-bold text-white absolute">Start Camera</p>
                </div> -->

                <div class="flex-1 mx-auto">
                    <p class="">Specify product first.</p>
                    <button onclick="openScanner(event)" class="w-full p-2 hover:bg-gray-200 border border-gray-400 rounded-lg">Capture <i class="fa fa-camera"></i></button>
                    <form class="fetch-product" method="POST">
                        @csrf
                        <div class='flex flex-col'>
                            <span class="text-center">or</span>
                            <input required placeholder="input barcode" type="text" class="mb-2 text-center rounded-lg code" name="code" id="code">
                            <button type="submit" class="search-button p-2 hover:bg-gray-200 border border-gray-400 rounded-lg">Search Product <i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="flex-1 px-4">
                    <p class="text-center">Product information:</p>
                    <div class="lg:flex mb-5">
                        <div class="bg-black mx-auto lg:m-0 h-24 w-24 border border-black flex items-center justify-center">
                            <img class="product-img object-contain h-24" src="{{asset('images/no_image.png')}}" alt="product">
                        </div>
                        <div class="px-2">
                            <p class="fetch-message text-center text-red-500">No product found.</p>
                            <ul class="product-info">
                                <li class="product-name truncate font-bold"><span class="text-gray-400"></span></li>
                                <li class="product-price truncate"><span class="text-gray-400"></span></li>
                                <li class="product-stock truncate font-bold"></li>
                            </ul>

                        </div>

                    </div>
                    <form class="restock-form" method="POST">
                        @csrf
                        <div class="lg:flex mb-2 items-center text-center">
                            <input id="id" type="hidden" name="id" value="">
                            <label class="mx-2 text-center" for="quantity">Quantity: </label><br>
                            <input disabled class="opacity-20 stock-input flex-1 w-5/6 lg:w-auto rounded-lg {{$errors->has('stock') ? 'border-red-500' : ''}}" oninput="numbersOnlyInput(event)" onkeydown="numbersOnlyKeydown(event)" required type="number" min="1" value="1" name="stock" id="stock">
                        </div>
                        <button disabled class="opacity-20 stock-button block mx-auto lg:ml-auto lg:mx-0 py-2 px-4 hover:bg-gray-200 border border-gray-400 rounded-lg">Restock</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>