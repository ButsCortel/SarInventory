@php


function addTotal($array)
{
$total = 0;
foreach ($array as $checkout) {
$total += ($checkout->product->price * $checkout->quantity);
}
return $total;
}


@endphp



<div class="bg-white flex flex-col mx-auto mb-4 p-6 shadow-md sm:rounded-lg h-full">
    <p class="font-bold text-4xl text-center">Total: &#8369;{{addTotal($checkouts)}} </p>
    <div class="flex-grow overflow-y-auto border-gray-400 border rounded-lg py-1 px-2">
        @foreach($checkouts as $checkout)
        <div>
            <p class="font-bold">{{$checkout->product->name}} x {{$checkout->quantity}} pc/s {{$checkout->product->price * $checkout->quantity}}</p>
        </div>
        @endforeach
    </div>
    <form action="">
        <div class="mt-1 font-bold text-xl flex flex-shrink justify-around">
            <div class="flex-shrink">
                <label for="payment">Payment: &#8369;</label><br>
                <input required class="rounded" type="number" min="0" value="0.00" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" id="payment" name="payment" />
            </div>
            <div class="flex-shrink">
                <label for="payment">Change: &#8369;</label><br>
                <input readonly class="rounded" type="text" id="change" value="0.00" name="change" />
            </div>
        </div>
        <div class="flex px-10">
            <button class="flex-grow border border-gray rounded-lg p-2 text-white font-bold my-1 bg-green-400">Checkout All</button>
            <button class="flex-grow border border-gray rounded-lg p-2 text-white font-bold my-1 bg-red-400">Reset</button>
        </div>
    </form>

</div>