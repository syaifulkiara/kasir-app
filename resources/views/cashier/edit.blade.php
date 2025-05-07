@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Item</h1>

    <form action="{{ route('cashier.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Item</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $item->name) }}" required>
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $item->price) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="stock">Stok</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $item->stock) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('cashier.index') }}" class="btn btn-info">Belanja</a>
    </form>
</div>
@endsection
