<?php
function convert($time)
{
    $date = new DateTime($time);
    return [$date->format('m/d/Y'), $date->format('h:i:s A')];
}

?>

@if(sizeof($sales)>0)
@foreach($sales as $sale)
<tr onclick="window.location=`{{route('sales.show', $sale->id)}}`" class="border hover:bg-gray-100 text-center cursor-pointer">
    <td title="{{implode(convert($sale->created_at))}}" class="border border-gray-300">
        @foreach(convert($sale->created_at) as $time)
        <span class="block">{{$time}}</span>
        @endforeach
    </td>
    <td class="border border-gray-300 truncate">{{$sale->user}}</td>
    <td class="border border-gray-300 truncate">
        @foreach($sale->checkouts as $checkout)
        <span class="block truncate">{{$checkout['product']['name']}} x {{$checkout['quantity']}} pc/s</span>
        @endforeach
    </td>
    <td class="border border-gray-300 truncate">&#8369;{{$sale->total}}</td>
    <td class="border border-gray-300 truncate">&#8369;{{$sale->payment}}</td>
    <td class="border border-gray-300 truncate">&#8369;{{$sale->change}}</td>
</tr>
@endforeach
@else
<tr>
    <td colspan="6" class="text-center p-3 text-2xl text-gray-400">No records available.</td>
</tr>
@endif