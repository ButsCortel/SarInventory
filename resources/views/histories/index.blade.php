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
            {{ __('History') }}
        </h2>

    </x-slot>

    <div class="py-5">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 bg-white overflow-auto border-b border-gray-200">
                <div class="overflow-auto">
                    <table class="mx-auto sm:w-full table-fixed">
                        <thead>
                            <tr class="border">
                                <th class="border">Date</th>
                                <th class="border">User</th>
                                <th class="border">Action</th>
                                <th class="border">Product</th>

                            </tr>
                        </thead>
                        <tbody class="sale-body">
                            @include('histories.history_body')
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>