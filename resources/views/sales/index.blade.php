<?php
function convert_12hr($time)
{
    $date = new DateTime($time);
    return [$date->format('m/d/Y'), $date->format('h:i:s A')];
}
?>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="mx-auto sm:w-full table-auto">
                        <thead>
                            <tr class="border">
                                <th class="border">Date</th>
                                <th class="border">User</th>
                                <th class="border">Items</th>
                                <th class="border">Total</th>
                                <th class="border">Payment</th>
                                <th class="border">Change</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $sale)
                            <tr onclick="window.location=`{{url('/sales').'/'.$sale->id}}`" class="border hover:bg-gray-100 text-center cursor-pointer">
                                <td title="{{implode(convert_12hr($sale->created_at))}}" class="border border-gray-300">
                                    @foreach(convert_12hr($sale->created_at) as $time)
                                    <span class="block">{{$time}}</span>
                                    @endforeach
                                </td>
                                <td class="border border-gray-300 truncate">{{$sale->user}}</td>
                                <td class="border border-gray-300 truncate">
                                    @foreach($sale->checkouts as $checkout)
                                    <span class="block">{{$checkout['product']['name']}} x {{$checkout['quantity']}} pc/s</span>
                                    @endforeach
                                </td>
                                <td class="border border-gray-300 truncate">&#8369;{{$sale->total}}</td>
                                <td class="border border-gray-300 truncate">&#8369;{{$sale->payment}}</td>
                                <td class="border border-gray-300 truncate">&#8369;{{$sale->change}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>