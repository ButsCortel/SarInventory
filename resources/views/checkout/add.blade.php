<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{route('products.index')}}">{{ __('Products') }}</a> <i class="fa fa-angle-right"></i> Add
            </h2>
            <a class="hover:bg-gray-200 text-center px-2 w-20 border border-gray rounded-full block" href="{{route('products.index')}}">Back <i class="fa fa-arrow-left"></i></a>
        </div>

    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mx-auto  w-5/6  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-yellow-500">* fields are required.</p>
                    <form class="add-product" action="/products" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="lg:flex justify-evenly">
                            <div class="flex-1 px-2">
                                <label for="name">Name <span class='text-yellow-500'>*</span></label><span class="text-red-500 ml-2">{{$errors->has('name')? '(Invalid input)' : ''}}</span>
                                <input value="{{old('name')}}" required class="block w-full rounded {{$errors->has('name') ? 'border-red-500' : ''}}" aria-placeholder="name" type="text" name="name" id="name">
                                <label for="description">Description</label>
                                <textarea class="h-24 block w-full rounded" style=" resize: none" name="description" id="description" rows="3">{{old('description')}}</textarea>

                            </div>
                            <div class="flex-1 px-2">
                                <label for="category">Category <span class='text-yellow-500'>*</span></label><span class="text-red-500 ml-2">{{$errors->has('category')? '(Invalid input)' : ''}}</span>
                                <select required class="block w-full rounded {{$errors->has('category') ? 'border-red-500' : ''}}" name="category" id="category">
                                    <option {{ old('category') == "" ? 'selected' : '' }} disabled>Select one...</option>
                                    <option {{ old('category') == "Health and Beauty" ? 'selected' : '' }} value="Health and Beauty">Health and Beauty</option>
                                    <option {{ old('category') == "Foods and Drinks" ? 'selected' : '' }} value="Foods and Drinks">Foods and Drinks</option>
                                    <option {{ old('category') == "Home Maintenance" ? 'selected' : '' }} value="Home Maintenance">Home and Living</option>
                                    <option {{ old('category') == "Others" ? 'selected' : '' }} value="Others">Others</option>
                                </select>
                                <div class="flex justify-between">
                                    <div class="flex-grow">
                                        <label for="price">Price <span class='text-yellow-500'>*</span> (&#8369;)</label><span class="text-red-500 ml-2">{{$errors->has('price')? '(Invalid input)' : ''}}</span>
                                        <input required class="block w-full rounded {{$errors->has('price') ? 'border-red-500' : ''}}" type="number" min="0" value="{{old('price') ? old('price') : 0.00}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" id="price" name="price" />
                                    </div>
                                    <div class="flex-grow">
                                        <label for="stock">Stock <span class='text-yellow-500'>*</span></label><span class="text-red-500 ml-2">{{$errors->has('stock')? '(Invalid input)' : ''}}</span>
                                        <input oninput="numbersOnlyInput(event)" onkeydown="numbersOnlyKeydown(event)" required class="block w-full rounded {{$errors->has('stock') ? 'border-red-500' : ''}}" type="number" min="1" value="{{old('stock') ? old('stock') : 1}}" name="stock" id="stock">
                                    </div>
                                </div>
                                <label for="thumbnail">Thumbnail</label><br>
                                <input type="file" name="thumbnail" id="thumbnail" accept="image/x-png,image/jpeg,image/jpg">
                            </div>
                        </div>
                        <button id="submit" type="submit" class="hover:bg-gray-200 block ml-auto rounded border border-gray-500 p-2">Add product</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>