@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Item Baru</h2>

        <form action="{{ route('cashier.storeItem') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Item</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="stock">Stok</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('cashier.index') }}" class="btn btn-info">Belanja</a>
        </form>
    </div>
@endsection
