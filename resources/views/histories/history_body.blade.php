<?php
function convert($time)
{
    $date = new DateTime($time);
    return [$date->format('m/d/Y'), $date->format('h:i:s A')];
}

?>

@if(sizeof($histories)>0)
@foreach($histories as $history)
<tr onclick="window.location=`{{route('history.show', $history->id)}}`" class="border hover:bg-gray-100 text-center cursor-pointer">
    <td title="{{implode(convert($history->created_at))}}" class="border border-gray-300">
        @foreach(convert($history->created_at) as $time)
        <span class="block">{{$time}}</span>
        @endforeach
    </td>
    <td class="border border-gray-300 truncate">{{$history->user->name}}</td>
    <td class="border border-gray-300 truncate">
        {{$history->action}}
    </td>
    <td class="border border-gray-300 truncate">{{$history->product->name}}</td>
</tr>
@endforeach
@else
<tr>
    <td colspan="6" class="text-center p-3 text-2xl text-gray-400">No records available.</td>
</tr>
@endif