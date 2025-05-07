@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Keranjang Belanja</h1>
    
    @if(session('cart') && count(session('cart')) > 0)
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach(session('cart') as $id => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price'], 2) }}</td>
                            <td>{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.delete', $id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total Keseluruhan</td>
                        <td>{{ number_format(array_reduce(session('cart'), function($sum, $item) {
                            return $sum + ($item['price'] * $item['quantity']);
                        }, 0), 2) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
        <a href="{{ route('cashier.index') }}" class="btn btn-info">Belanja</a>
        
    @else
        <p>Keranjang Anda kosong.</p>
        <a href="{{ route('cashier.index') }}" class="btn btn-info">Belanja Sekarang</a>
    @endif
</div>
@endsection