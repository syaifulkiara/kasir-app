<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
Use Alert;

class CashierController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $transactions = Transaction::orderBy('created_at', 'desc')->get();

        return view('cashier.index', compact('items', 'transactions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'items' => 'required|array',
            'quantities' => 'required|array',
        ]);

        $transaction = new Transaction();
        $itemsData = [];

        foreach ($request->items as $index => $itemId) {
            $item = Item::find($itemId);
            if ($item) {
                $quantity = $request->quantities[$index];
                $itemsData[] = [
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $quantity,
                ];
            }
        }

        $transaction->items = json_encode($itemsData);
        $transaction->total = array_sum(array_column($itemsData, 'price')) * array_sum($request->quantities);
        $transaction->save();

        return redirect()->route('cashier.index')->with('success', 'Transaction completed!');
    }

    public function create()
    {
        return view('cashier.create');  // Menampilkan form untuk membuat item baru
    }

    public function storeItem(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Membuat item baru
        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->save();

        Alert::success('Berhasil', 'Item berhasil ditambahkan!');
        return redirect()->route('cashier.index')->with('success', 'Item added successfully!');
    }

    public function edit($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('cashier.index')->with('error', 'Item tidak ditemukan!');
        }

        return view('cashier.edit', compact('item'));
    }

    // Menyimpan perubahan item setelah diedit
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('cashier.index')->with('error', 'Item tidak ditemukan!');
        }

        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->save();

        return redirect()->route('cashier.index')->with('success', 'Item berhasil diperbarui!');
    }

    public function delete($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('cashier.index')->with('error', 'Item tidak ditemukan!');
        }

        $item->delete();

        return redirect()->route('cashier.index')->with('success', 'Item berhasil dihapus!');
    }

    public function addToCart(Request $request)
    {
        // Validasi input dari pengguna
        $this->validate($request, [
            'item_id' => 'required|exists:items,id', // Pastikan item_id ada di tabel items
            'quantity' => 'required|integer|min:1|max:100', // Pastikan quantity valid
        ]);

        // Ambil item berdasarkan ID
        $item = Item::find($request->item_id);

        // Cek apakah stok cukup
        if ($item->stock < $request->quantity) {
            return redirect()->route('cashier.index')->with('error', 'Stok tidak cukup untuk item ' . $item->name);
        }

        // Ambil cart dari session atau buat baru
        $cart = session()->get('cart', []);

        // Menambah kuantitas atau menambah item baru
        if (isset($cart[$item->id])) {
            $cart[$item->id]['quantity'] += $request->quantity;
        } else {
            // Pastikan ID juga disimpan
            $cart[$item->id] = [
                'id' => $item->id,   // Simpan ID ke dalam keranjang
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $request->quantity,
            ];
        }

        // Simpan cart yang diperbarui ke session
        session()->put('cart', $cart);
        Alert::success('Berhasil', 'Berhasil Menambahkan Item');
        return redirect()->route('cashier.index')->with('success', 'Item added to cart!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            Alert::success('Berhasil', 'Berhasil Hapus Item Dari Cart');
        }

        return redirect()->route('cashier.cart')->with('success', 'Item removed from cart!');
    }

    public function showCart()
    {
        // Mengambil isi keranjang dari session
        $cart = session()->get('cart', []);
        // dd($cart); 
        // Menghitung total dari keranjang, jika diperlukan
        $totalCart = 0;
        foreach ($cart as $item) {
            $totalCart += $item['price'] * $item['quantity'];
        }

        // Mengembalikan tampilan dan mengirimkan data keranjang serta totalnya
        return view('cashier.cart', compact('cart', 'totalCart'));
    }

    public function checkout()
    {
        $cart = session()->get('cart');

        if (empty($cart)) {
            return redirect()->route('cashier.cart')->with('error', 'Keranjang Anda kosong!');
        }

        $transaction = new Transaction();
        
        $transactionItems = [];
        foreach ($cart as $item) {
            // Debug untuk melihat isi dari item
            if (!isset($item['id'])) {
                return redirect()->route('cashier.cart')->with('error', 'Item dalam keranjang tidak memiliki ID.');
            }

            // Mencari item di database menggunakan ID
            $itemModel = Item::find($item['id']);

            if ($itemModel) {
                // Memeriksa apakah stok cukup
                if ($itemModel->stock >= $item['quantity']) {
                    // Mengurangi stok
                    $itemModel->stock -= $item['quantity'];
                    $itemModel->save(); // Simpan perubahan stok

                    // Menyimpan item transaksi
                    $transactionItems[] = [
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                    ];
                } else {
                    return redirect()->route('cashier.cart')->with('error', "Stok untuk item '{$item['name']}' tidak cukup.");
                }
            } else {
                return redirect()->route('cashier.cart')->with('error', "Item '{$item['name']}' tidak ditemukan.");
            }
        }

        // Simpan item dalam format JSON
        $transaction->items = json_encode($transactionItems);
        
        // Hitung total
        $total = array_reduce($transactionItems, function($sum, $current) {
            return $sum + ($current['price'] * $current['quantity']);
        }, 0);
        
        $transaction->total = $total;
        $transaction->created_at = Carbon::now();
        $transaction->save();
        Alert::success('Berhasil', 'Berhasil Checkout Items');
        // Kosongkan keranjang
        session()->forget('cart');

        return redirect()->route('cashier.index')->with('success', 'Checkout successful!');
    }

    public function printReceipt($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect()->route('cashier.index')->with('error', 'Transaction not found!');
        }

        $items = json_decode($transaction->items, true);
    
        if (!is_array($items)) {
            return redirect()->route('cashier.index')->with('error', 'Invalid item data!');
        }

        $total = $transaction->total;

        $pdf = Pdf::loadView('cashier.receipt', compact('items', 'total'));
        return $pdf->download('receipt_' . $id . '.pdf');
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect()->route('cashier.index')->with('error', 'Transaction not found!');
        }

        $transaction->delete();
        Alert::success('Berhasil', 'Berhasil Hapus Item');

        return redirect()->route('cashier.index')->with('success', 'Transaction deleted successfully!');
    }


}
