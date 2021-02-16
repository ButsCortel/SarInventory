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
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-rows-1 lg:grid-cols-8 grid-cols-4 gap-4">

            <div class="row-span-1 col-span-4 rounded-lg shadow-lg p-4 bg-white border border-gray-200">
                <div class="font-bold text-xl">Products for restock <button onclick="window.location=`{{url('/products')}}`"><i class="fa fa-eye"></i></button></div>
                @if(count($products) > 0 )
                <div class="overflow-y-auto grid grid-flow-col auto-cols-max gap-2 border border-gray-400 p-1 ">
                    @foreach($products as $product)
                    <div onclick="window.location=`{{url('/products').'/'.$product->id}}`" class="hover:bg-gray-100 cursor-pointer row-span-1 p-4 border border-gray-400 rounded-md shadow-md">
                        <img class="object-contain h-44 mx-auto" src="{{$product->thumbnail? $product->thumbnail : asset('images/no_image.png')}}" alt="product">
                        <ul>
                            <li>{{$product->name}}</li>
                            <li class="{{$product->stock < 3? 'text-red-500' : 'text-yellow-600'}} font-bold">{{$product->stock}} pc/s left</li>
                        </ul>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center text-gray-500 text-lg mt-5">
                    <div>Hooray! No products for restock.</div>
                </div>
                @endif


            </div>
            <div class="rounded-lg shadow-lg col-span-4 md:col-span-2 row-span-1 p-4 bg-white border border-gray-200">
                <div class="font-bold text-xl">Sales <button onclick="window.location=`{{url('/sales')}}`"><i class="fa fa-eye"></i></button></div>
                <div class="grid grid-rows-3 gap-4">
                    <div class="p-2 border border-gray-400 rounded-lg">
                        <div>Today:</div>
                        <div class="text-center text-3xl font-bold">&#8369;{{$todayTotal}}</div>
                    </div>
                    <div class="p-2 border border-gray-400 rounded-lg">
                        <div>Last 7 days:</div>
                        <div class="text-center text-3xl font-bold">&#8369;{{$lastWeekTotal}}</div>
                    </div>
                    <div class="p-2 border border-gray-400 rounded-lg">
                        <div>Last 30 days:</div>
                        <div class="text-center text-3xl font-bold">&#8369;{{$lastMonthTotal}}</div>
                    </div>
                </div>
            </div>
            <div class="rounded-lg shadow-lg col-span-4 md:col-span-2 row-span-1 p-4 bg-white border border-gray-200">
                <div class="font-bold text-xl">Most Recent <button onclick="window.location=`{{url('/history')}}`"><i class="fa fa-eye"></i></button></div>

                @if(count($histories) > 0 )
                @foreach($histories as $history)
                <div onclick="window.location=`{{url('/history').'/'.$history->id}}`" class="border border-gray-400 rounded-lg px-1 my-1 hover:bg-gray-200 cursor-pointer">
                    {{convert_12hr($history->created_at)[0]}} {{$history->action}}
                </div>
                @endforeach
                @else
                <div class="text-center text-gray-500 text-lg mt-5">No recent transaction.</div>
                @endif



            </div>



        </div>
    </div>
</x-app-layout>