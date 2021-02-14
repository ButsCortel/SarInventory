<?php


function convert_12hr($time)
{
    $date = new DateTime($time);
    return [$date->format('m/d/Y'), $date->format('h:i:s A')];
}
function current_date()
{
    return date("Y-m-d");
}
?>


<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-grow">
            {{ __('Sales') }}
        </h2>



    </x-slot>

    <div class="py-5">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 bg-white overflow-auto border-b border-gray-200 mb-2">
                <h1 class="font-bold">Summary</h1>
                <div class="md:flex justify-evenly p-2">
                    <div class="flex items-center flex-1 p-2 border border-gray-400 rounded-lg shadow-md">
                        <div class="flex-1">
                            <h2 class="font-bold">Past 30 days</h2>
                            <div>{{$lastMonth[1]}} item/s sold</div>
                        </div>
                        <div class="flex-1 text-center text-2xl"><span class="font-bold">&#8369;{{$lastMonth[0]}}</span> total</div>

                    </div>
                    <div class="flex items-center flex-1 p-2 border border-gray-400 rounded-lg shadow-md">
                        <div class="flex-1">
                            <h2 class="font-bold">Past 7 days</h2>
                            <div>{{$lastWeek[1]}} item/s sold</div>
                        </div>
                        <div class="flex-1 text-center text-2xl"><span class="font-bold">&#8369;{{$lastWeek[0]}}</span> total</div>
                    </div>
                    <div class="flex items-center flex-1 p-2 border border-gray-400 rounded-lg shadow-md">
                        <div class="flex-1">
                            <h2 class="font-bold">Today</h2>
                            <div>{{$today[1]}} item/s sold</div>
                        </div>
                        <div class="flex-1 text-center text-2xl"><span class="font-bold">&#8369;{{$today[0]}}</span> total</div>
                    </div>

                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6 bg-white overflow-auto border-b border-gray-200">
                <div class="flex  mb-2 md:justify-end justify-center">
                    <form class="date-filter">
                        <div class="flex flex-col md:flex-row items-center">

                            <label for="from" class="mx-1">From:</label>
                            <input class="rounded-lg h-6" type="date" name="from" id="from" value="{{date('Y-m-d')}}">
                            <label for="to" class="mx-1">To:</label>
                            <input class="rounded-lg h-6" type="date" name="to" id="to" value="{{date('Y-m-d')}}">
                            <button id="apply" class=" my-1 md:my-auto h-6 border border-gray-400 hover:bg-gray-200 rounded-lg px-1 mx-1">Apply</button>
                            <button id="clear" class="h-6 border border-gray-400 hover:bg-gray-200 rounded-lg px-1 mx-1">Clear</button>
                        </div>
                    </form>
                </div>
                <div class="overflow-auto">
                    <table class="mx-auto sm:w-full table-fixed">
                        <thead>
                            <tr class="border">
                                <th class="border">Date</th>
                                <th class="border">Cashier</th>
                                <th class="border">Items</th>
                                <th class="border">Total</th>
                                <th class="border">Payment</th>
                                <th class="border">Change</th>
                            </tr>
                        </thead>
                        <tbody class="sale-body">
                            @include('sales.sale_body')
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>