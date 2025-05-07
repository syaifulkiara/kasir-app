@extends('layouts.app')

@section('content')
<div class="container">
     @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <a href="{{ route('cashier.create') }}" class="btn btn-success mb-3">Tambah Item</a>
    <a href="{{ route('cashier.cart') }}" class="btn btn-warning mb-3">Lihat Keranjang</a>
    <h1>Daftar Item</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th>Stock</th>
                <th>Harga</th>
                <th>Operasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
                            <button type="submit" class="btn btn-primary">Tambahkan ke Keranjang</button>
                        </form>
                        <!-- Tombol Edit -->
                        <a href="{{ route('cashier.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <!-- Tombol Hapus -->
                        <form action="{{ route('cashier.delete', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
</div>

<div class="container mt-2">
    <h1>List Transaksi</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Items</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td width="50%">{{ $transaction->items }}</td>
                
                <td>{{ number_format($transaction->total, 2) }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td>
                    <a href="{{ route('cashier.receipt', ['id' => $transaction->id]) }}" class="btn btn-success">Cetak Struk</a>
                    <form action="{{ route('cashier.transaction.destroy', ['id' => $transaction->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection