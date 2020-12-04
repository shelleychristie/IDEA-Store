@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-content-center">
        <div class="col-12 pt-3 pb-2">
            <h2 style="text-align: center">Your Transaction History</h2>
        </div>
    </div>
    <hr style="width: 50%">
    @if ($transactions->isNotEmpty())
            @foreach ($transactions as $transaction)
            @php
                $total = 0;
                $datetime = date('l, jS \of F Y \a\t h:i:s A', strtotime($transaction->created_at));
            @endphp
            <div id="transaction" class="col-12 my-5">
                <div class="pb-3"><h3>{{$datetime}}</h3></div>
                @foreach ($transaction->transactionDetails()->get() as $detail)
                <div class="col-12 pb-3 pt-3 d-flex align-items-center" style="border: 1px solid lightgray; background: white;">
                    <a href="/product/{{$detail->product_id}}"><img src="{{$detail->getImage()}}" alt="" style="object-fit: cover; width:150px; height: 150px;"></a>
                    <div class="col-2 d-flex" style="">
                        Product: <br>
                        {{$detail->name}}
                    </div>
                    <div class="col-2  px-0">
                        Quantity: {{$detail->quantity}}
                    </div>
                        @php
                        $subtotal = ($detail->price)*($detail->quantity);
                        $total += $subtotal;
                        $subtotal = number_format($subtotal);
                        $detail->price = number_format($detail->price);
                        @endphp
                    <div class="col-2 d-flex ml-3" style="">
                        Price: <br>
                        {{$detail->price}}
                    </div>
                    <div class="col-2 d-flex" style="">
                        Subtotal: <br>
                        {{$subtotal}}
                    </div>
                </div>
                @endforeach
                <div class="row mt-3">
                    <div class="col-12 text-right">
                        @php
                            $total = number_format($total);
                        @endphp
                        <h4>Total: Rp {{$total}}</h4>
                    </div>
                </div>
            </div>
        @endforeach
    @else
    <div class="col-12 text-center">You haven't made any transactions yet.</div>
    @endif
</div>
@endsection
