<div x-data="{showOrder: @entangle('showOrder')}">
    <div class="d-flex">
        <h2 class="h5 text-uppercase mb-4">Orders</h2>
    </div>


    <div class="my-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order Ref.</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="col-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr wire:key="{{$order->id}}">
                            <td>{{$order->ref_id}}</td>
                            <td>{{$order->currency().' '.$order->total}}</td>
                            <td>{!! $order->statusWithLabel() !!}</td>
                            <td>{{$order->created_at->format('d-m-Y') }}</td>
                            <td class="text-right">
                                <button type="button" wire:click="displayOrder('{{$order->id}}')" x-on:click="showOrder = true" class="btn btn-success btn-sm">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <p class="text-center">No orders found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div x-show="showOrder" x-on:click.away="showOrder=false" class="border rounded shadow p-4">
            <div class="table-responsive mb-4">
                <table class="table">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Product</strong></th>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Price</strong></th>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Quantity</strong></th>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Total</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                       

                        @if ($order_show)
                            @foreach ($order_show->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $order->currency() . ' ' . number_format( $product->price , 2) }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ $order->currency() . ' ' . number_format( $product->price * $product->pivot->quantity , 2) }}</td>
                                </tr>
                            @endforeach
                        
                            <tr>
                                <td colspan="3" style="text-align: right"><strong>Subtotal</strong> </td>
                                <td>{{ $order->currency() . ' ' . number_format( $order_show->subtotal , 2 ) }}</td>
                            </tr>                        
                            @if (!is_null($order->discount_code))
                                <tr>
                                    <td colspan="3" style="text-align: right"><strong>Discount ({{$order->discount_code}})</strong> </td>
                                    <td>{{ $order->currency() . ' ' . number_format( $order_show->discount  , 2)}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="3" style="text-align: right"><strong>Tax</strong> </td>
                                <td>{{ $order->currency() . ' ' . number_format( $order_show->tax , 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right"><strong>Amount</strong> </td>
                                <td>{{ $order->currency() . ' ' . number_format( $order_show->total , 2)}}</td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
            </div>

            <!-- Transactions Table  -->
            <h2 class="h5 text-uppercase">Transactions</h2>

            <div class="table-responsive mb-4">
                <table class="table">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Transaction</strong></th>
                            <th class="border-0" scope="col"><strong class="text-small text-uppercase">Date</strong></th>
                            {{-- <th class="border-0" scope="col"><strong class="text-small text-uppercase">Days</strong></th> --}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- check if order_show is set before click or not  --}}
                        @if ($order_show)
                            @foreach ($order_show->transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->status($transaction->transaction) }}</td>
                                    <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                                    {{-- <td>{{ \Carbon\Carbon::now()->addDays(5)->diffInDays($transaction->created_at->format('Y-m-d')) }}</td> --}}
                                    <td>
                                        @if (
                                            $loop->last &&
                                            $transaction->transaction == \App\Models\OrderTransaction::FINISHED &&
                                            \Carbon\Carbon::now()->addDays(5)->diffInDays($transaction->created_at->format('Y-m-d')) != 0
                                        )

                                        <button type="button" wire:click="requestReturnOrder('{{ $order->id }}')" class="btn btn-link text-right"> 
                                            you can return order in {{ 5 - $transaction->created_at->diffInDays() }} days
                                        </button>
                                            
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
 