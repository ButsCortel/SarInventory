<div class="total-table-div flex flex-col mx-auto mb-4 p-6  h-full">
    <div class="flex text-center my-1">
        <p class="flex-1 font-bold text-4xl">Total:</p>
        <p class="flex-1 font-bold text-4xl">&#8369;{{$total}} </p>
    </div>
    <div class="w-full flex-grow overflow-y-auto border border-black">
        <table class="table-fixed max-h-full w-full">
            <thead class=" ">
                <tr class='border border-gray-400'>
                    <th class='truncate border border-gray-400'>Name</th>
                    <th class='truncate border border-gray-400'>Qty.</th>
                    <th class='truncate border border-gray-400'>Price</th>
                    <th class='truncate border border-gray-400'>S.total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkouts as $checkout)
                <tr>
                    <td class="border border-gray-300 px-1  text-center truncate">{{$checkout->product->name}}</td>
                    <td class="border border-gray-300 px-1 text-right truncate">{{$checkout->quantity}}</td>
                    <td class="border border-gray-300 px-1 text-right truncate">&#8369; {{$checkout->product->price}}</td>
                    <td class="border border-gray-300 px-1 text-right truncate">&#8369; {{$checkout->product->price * $checkout->quantity}}</td>
                </tr>
                @endforeach
            </tbody>


        </table>

    </div>
    <form class="submit-checkout">
        <div class="mt-1 font-bold text-xl flex flex-shrink justify-around">
            <div class="">


                <div class="sm:flex min-w-0  items-center">
                    <label class="flex-1 text-right pr-2" for="payment">Payment: &#8369; </label>
                    <input required class="min-w-0 flex-1 text-xl font-bold p-1 text-right rounded" type="number" min="0" value="0.00" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" id="payment" name="payment" />

                </div>
                <div class="sm:flex min-w-0  items-center">
                    <label class="flex-1 text-right pr-2" for="change">Change: &#8369; </label><br>
                    <input readonly class="min-w-0 flex-1 text-xl font-bold p-1 text-right rounded" type="text" id="change" value="0.00" name="change" />

                </div>
            </div>

        </div>
        <div class="flex justify-around">
            <input type="hidden" name="total" id="total" class="total" value="{{$total}}">
            <button onclick="resetCheckout(event)" id="reset-btn" class="{{empty($checkouts)? 'pointer-events-none opacity-50':''}} flex-1 border border-gray rounded-lg p-2 text-white font-bold my-1 bg-red-400">Reset</button>
            <button onclick="submitCheckout(event)" id="checkout-btn" class="{{empty($checkouts)? 'pointer-events-none opacity-50':''}} flex-1 border border-gray rounded-lg p-2 text-white font-bold my-1 bg-blue-400">Checkout</button>
        </div>
        <button onclick="doneCheckout(event)" id="done-btn" class="w-full pointer-events-none opacity-50 flex-1 border border-gray rounded-lg p-2 text-white font-bold my-1 bg-green-400">Done</button>
    </form>

</div>

<script>
    storeJSON(<?php echo @json_encode($checkouts) ?>);
</script>