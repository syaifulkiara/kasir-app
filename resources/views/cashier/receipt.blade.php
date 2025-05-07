<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <style>
        body {
            font-family: monospace; /* Menggunakan monospace untuk ketentuan printer */
            font-size: 14px; /* Ukuran font yang mudah dibaca */
            margin: 0; /* Menghindari margin yang terlalu lebar */
            padding: 0; /* Menghindari padding yang terlalu besar */
            background-color: #f4f4f4; /* Latar belakang yang lebih cerah untuk kontras */
        }
        .container {
            width: 90%; /* Lebar kontainer */
            max-width: 600px; /* Lebar maksimum untuk pencetakan */
            margin: 20px auto; /* Pusatkan kontainer */
            background: #fff; /* Latar belakang putih untuk isi */
            padding: 20px; /* Padding untuk konten */
            border-radius: 5px; /* Sudut yang sedikit membulat */
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); /* Bayangan lembut untuk efek mengangkat */
        }
        h2, h4 {
            text-align: center;
            margin: 5px 0; /* Jarak atas dan bawah pada judul */
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Menghapus border yang berlebihan */
        }
        th, td {
            text-align: right; /* Memastikan semua teks searah */
            padding: 2px; /* Padding kecil untuk tidak memakan tempat */
        }
        th {
            padding-bottom: 5px; /* Ruang pada judul tabel */
            text-align: right; /* Mengatur judul tabel untuk kiri, kecuali kolom angka */
        }
        .total {
            font-weight: bold; /* Total yang ditebalkan */
            text-align: right; /* Menyelaraskan teks total ke kanan */
        }
        /* Gaya khusus untuk <hr> */
        hr {
            border: none; /* Menghapus border default */
            height: 1px; /* Tinggi garis */
            background-color: #000; /* Warna garis hitam */
            margin: 10px 0; /* Jarak atas dan bawah */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Nama Toko</h2>
        <h4>Alamat Toko</h4>
        <h4>Telepon: 123456789</h4>
        <hr>
        <h4>Receipt</h4>
        <h4>{{ Carbon\Carbon::now()->translatedFormat('l, d F Y H:i') }}</h4>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price'], 2) }}</td>
                        <td>{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <h4 class="total">Total: {{ number_format($total, 2) }}</h4>
        <h4 style="text-align: right;">Terima Kasih!</h4>
    </div>
</body>
</html>