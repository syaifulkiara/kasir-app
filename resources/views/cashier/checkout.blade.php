@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>
    
    @if(session('cart') && count(session('cart')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach(session('cart') as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price'], 2) }}</td>
                        <td>
                            @php 
                                $total = $item['price'] * $item['quantity'];
                                $grandTotal += $total; 
                            @endphp
                            {{ number_format($total, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total Belanja: {{ number_format($grandTotal, 2) }}</h4>

        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Konfirmasi Pembelian</button>
        </form>
    @else
        <p>Keranjang Anda kosong. Silakan belanja terlebih dahulu.</p>
        <a href="{{ route('cashier.index') }}" class="btn btn-info">Belanja Sekarang</a>
    @endif
</div>
@endsection