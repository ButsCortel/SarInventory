<?php
function convert_12hr($time)
{
    $date = new DateTime($time);
    return [$date->format('m/d/Y'), $date->format('h:i:s A')];
}

?>
<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="flex-1 min-w-0 font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{route('history.index')}}">{{ __('History') }}</a> <i class="fa fa-angle-right"></i> <span class="inline-block w-5/6 truncate align-top">{{implode("-",convert_12hr($history->created_at))}}</span>
            </h2>
            <a class="shadow table align-middle flex-shrink-0 ml-auto hover:bg-gray-200 text-center px-2 w-20 border border-gray rounded-full " href="{{route('history.index')}}">Back <i class="fa fa-arrow-left"></i></a>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mx-auto p-6  w-5/6  overflow-hidden shadow-md sm:rounded-lg">

                <div class="lg:flex">

                    <div class="min-w-0">
                        <img class="object-contain h-28 w-28 mx-auto" src="{{$product->thumbnail? $product->thumbnail : asset('images/no_image.png')}}" alt="product">
                        <ul class="px-3 text-center">
                            <li title="{{$product->name}}" class="truncate text-2xl font-bold">{{$product->name}}</li>
                            <li class="font-bold truncate">&#8369; {{$product->price}}</li>
                        </ul>


                    </div>
                    <div class="p-6 flex-1 min-w-0 rounded-lg border border-gray-400 mt-3 lg:mt-0">
                        <ul>
                            <li class="truncate">{{convert_12hr($history->created_at)[0]}} at {{convert_12hr($history->created_at)[1]}}</li>
                            <li class="truncate" title="{{$user->email}}">User: {{$user->name}}</li>
                            <li class="truncate">Action: {{$history->action}}</li>
                            <li class="truncate">Previous Stock: {{$history->previous_stock}}</li>
                            <li class="truncate">Updated Stock: {{$history->stock}}</li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>