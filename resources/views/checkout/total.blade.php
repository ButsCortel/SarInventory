<div class="total-table-div flex flex-col mx-auto mb-4 p-6  h-full">
    <div class="flex text-center my-1">
        <p class="flex-1 font-bold text-4xl">Total:</p>
        <p class="flex-1 font-bold text-4xl">&#8369;{{$total}} </p>
    </div>
    <div class="w-full flex-grow overflow-y-auto border border-black">
        <table class="table-fixed max-h-full w-full">
            <thead class=" ">
                <tr class='border border-gray-400'>
                    <th class='border border-gray-400'>Name</th>
                    <th class='border border-gray-400'>Quantity</th>
                    <th class='border border-gray-400'>Price</th>
                    <th class='border border-gray-400'>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkouts as $checkout)
                <tr>
                    <td class="px-2  truncate">{{$checkout->product->name}}</td>
                    <td class="px-2 text-right truncate">{{$checkout->quantity}} pc/s </td>
                    <td class="px-2 text-right truncate">&#8369; {{$checkout->product->price}}</td>
                    <td class="px-2 text-right truncate">&#8369; {{$checkout->product->price * $checkout->quantity}}</td>
                </tr>
                @endforeach
            </tbody>


        </table>

    </div>
    <form>
        <div class="mt-1 font-bold text-xl flex flex-shrink justify-around">
            <div class="">
                <input type="hidden" name="total" id="total" class="total" value="{{$total}}">
                <label for="payment">Payment:</label>
                <div class="flex  items-center">
                    <input required class="p-1 text-right rounded" type="number" min="0" value="0.00" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" step="0.01" id="payment" name="payment" />
                    PHP
                </div>
                <label for="payment">Change:</label><br>
                <div class="flex  items-center">
                    <input readonly class="p-1 text-right rounded" type="text" id="change" value="0.00" name="change" />
                    PHP
                </div>
            </div>

        </div>
        <div class="flex justify-around">
            <input type="hidden" name="total">
            <button onclick="resetCheckout(event)" id="reset-btn" class="{{empty($checkouts)? 'pointer-events-none opacity-50':''}} flex-1 border border-gray rounded-lg p-2 text-white font-bold my-1 bg-red-400">Reset</button>
            <button id="checkout-btn" class="pointer-events-none opacity-50 flex-1 border border-gray rounded-lg p-2 text-white font-bold my-1 bg-green-400">Checkout</button>
        </div>
    </form>

</div>