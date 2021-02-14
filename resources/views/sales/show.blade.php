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
                <a href="{{route('sales.index')}}">{{ __('Sales') }}</a> <i class="fa fa-angle-right"></i> <span class="inline-block w-5/6 truncate align-top">{{implode("-",convert_12hr($sale->created_at))}}</span>
            </h2>
            <a class="shadow table align-middle flex-shrink-0 ml-auto hover:bg-gray-200 text-center px-2 w-20 border border-gray rounded-full " href="{{route('sales.index')}}">Back <i class="fa fa-arrow-left"></i></a>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:flex border-gray-200 md:h-96">
                    <div class="rounded-lg border border-gray-300 shadow-sm mb-3 md:mb-0  overflow-y-none overflow-x-auto flex-shrink-0 h-96 md:h-auto">

                        @foreach($sale->checkouts as $checkout)
                        <div onclick="window.location=`{{url('/products').'/'.$checkout['product']['id']}}`" class="w-full hover:bg-gray-200 cursor-pointer border p-3 border-gray-400 rounded-lg mb-1">
                            <div class="flex items-center">
                                <img class="object-contain h-32 w-32 mx-auto" src="{{$checkout['product']['thumbnail']? $checkout['product']['thumbnail'] : asset('images/no_image.png')}}" alt="product">
                                <div class="min-w-0 flex-grow md:w-40">
                                    <p class="text-xs truncate">Name:</p>
                                    <p class="truncate">{{$checkout['product']['name']}}</p>
                                    <p class="text-xs truncate">Price:</p>
                                    <p class="truncate">&#8369;{{$checkout['product']['price']}}</p>
                                    <p class="text-xs truncate">Quantity:</p>
                                    <p class="truncate ">{{$checkout['quantity']}} pc/s</p>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                    <div class="shadow-md flex flex-col h-full flex-grow border border-gray-400 rounded-md p-4 mx-2 ml-3 h-full">
                        <div class="">
                            <p class="truncate">Date: {{convert_12hr($sale->created_at)[0]}}</p>
                            <p class="truncate">Time: {{convert_12hr($sale->created_at)[1]}}</p>
                            <p class="truncate">Cashier: {{$user->name}}</p>
                        </div>
                        <div class="flex-grow w-full border border-gray-400">
                            <table class="table-fixed w-full mx-auto">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-400">Name</th>
                                        <th class="border border-gray-400">Price</th>
                                        <th class="border border-gray-400">Qty.</th>
                                        <th class="border border-gray-400">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sale->checkouts as $checkout)
                                    <tr>
                                        <td class="text-center truncate border border-gray-400">{{$checkout['product']['name']}}</td>
                                        <td class="text-center truncate border border-gray-400">&#8369;{{$checkout['product']['price']}}</td>
                                        <td class="text-center truncate border border-gray-400">{{$checkout['quantity']}} pc/s</td>
                                        <td class="text-center truncate border border-gray-400">&#8369;{{$checkout['product']['price'] * $checkout['quantity']}}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-around">
                            <div>
                                <div>Total</div>
                                <div class="text-2xl font-bold">&#8369;{{$sale->total}}</div>
                            </div>
                            <div>
                                <div>Payment</div>
                                <div class="text-2xl font-bold">&#8369;{{$sale->payment}}</div>
                            </div>
                            <div>
                                <div>Change</div>
                                <div class="text-2xl font-bold">&#8369;{{$sale->change}}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>