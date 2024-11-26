@extends('layout.mastar')
@section('title','Billing')
@section('content')
<div class="card p-3">
    <h3>Billing</h3>
    <h5 for="" class="mb-3">Customer Email: {{ $bill->email ? $bill->email : '-' }}</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>purchase price</th>
                <th>Tax % for Item</th>
                <th>Tax Payable for Item</th>
                <th>Total Price of the Item</th>
            </thead>
            <tbody>
                @if(count($bill->billedProducts) > 0)
                @foreach ($bill->billedProducts as $billed)
                <tr>
                    <td>{{ isset($billed->product) ? $billed->product->product_id : '-' }}</td>
                    <td>{{ isset($billed->product) ? $billed->product->name : '-' }}</td>
                    <td>{{ isset($billed->product) ? $billed->product->price : '-' }}</td>
                    <td>{{ isset($billed->product) ? $billed->quantity : '-' }}</td>
                    <td>{{ isset($billed->product) ? $billed->product->price * $billed->quantity : 0 }}</td>
                    <td>{{ isset($billed->product) ? $billed->product->tax : '0%' }}</td>
                    <td>{{ isset($billed->product) ? $billed->product->tax * ($billed->product->price * $billed->quantity) / 100 : 0 }}</td>
                    <td>{{ isset($billed->product) ? ($billed->product->price * $billed->quantity) + ($billed->product->tax * ($billed->product->price * $billed->quantity) /100) : 0 }}</td>

                </tr>
                @endforeach
                @else
                <td colspan="8" class="text-center">No Data Available</td>
                @endif
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end flex-column align-items-end mt-5">
        @if(count($billing_totals) > 0)
        <label class="mb-2" for="">Total Price Without Tax: {{ $billing_totals['total_price_without_tax'] }}</label>
        <label class="mb-2" for="">Total Tax Payable: {{ $billing_totals['total_tax_payable'] }}</label>
        <label class="mb-2" for="">Net Price of the Purchased Item: {{ $billing_totals['net_price'] }}</label>
        <label class="mb-2" for="">Rounded Down Value of the Purchased Items Net Price: {{ $billing_totals['rounded_net_price'] }}</label>
        <label class="mb-2" for="">Balance Payable to the Customer: {{ $billing_totals['balance_payable'] }}</label>
        @endif
    </div>
</div>
<div class="card p-3 mt-4">
    <h3>Balance Denomination</h3>
    <div class="d-flex justify-content-end flex-column align-items-end mt-5">
        <label for="" class="mb-2">500: {{ $denomination[500] }}</label>
        <label for="" class="mb-2">50: {{ $denomination[50] }}</label>
        <label for="" class="mb-2">20: {{ $denomination[20] }}</label>
        <label for="" class="mb-2">10: {{ $denomination[10] }}</label>
        <label for="" class="mb-2">5: {{ $denomination[5] }}</label>
        <label for="" class="mb-2">2: {{ $denomination[2] }}</label>
        <label for="" class="mb-2">1: {{ $denomination[1] }}</label>
    </div>
</div>
@endsection
@push('css')

@endpush