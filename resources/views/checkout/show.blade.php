<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{route('products.index')}}">{{ __('Products') }}</a> <i class="fa fa-angle-right"></i> Details
            </h2>
            <a class="hover:bg-gray-200 text-center px-2 w-20 border border-gray rounded-full block" href="{{route('products.index')}}">Back <i class="fa fa-arrow-left"></i></a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Details
                </div>
            </div>
        </div>
    </div>
</x-app-layout>