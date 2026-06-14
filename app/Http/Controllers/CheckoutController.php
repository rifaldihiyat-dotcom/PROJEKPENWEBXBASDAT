<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;
use App\Models\Buah;
use App\Models\Transaksi;

class CheckoutController extends Controller
{
    /**
     * Process checkout: validate cart, decrement stock and create transaksi records inside DB transaction.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'cart' => 'required|array|min:1',
            'cart.*.id' => 'required|integer',
            'cart.*.qty' => 'required|integer|min:1',
        ]);

        $cart = $data['cart'];

        try {
            foreach ($cart as $item) {
                $buah = Buah::where('id_buah', $item['id'])->first();
                if (! $buah) {
                    throw ValidationException::withMessages(['cart' => "Produk dengan id {$item['id']} tidak ditemukan."]);
                }

                $qty = intval($item['qty']);

                try {
                    // Memanggil stored procedure yang sudah Anda buat
                    // Ini otomatis meng-handle insert tabel transaksi dan update tabel stok, beserta transaksinya
                    DB::statement('CALL KurangiStok(?, ?, ?)', [$buah->id_buah, $qty, 'Pembelian via landing page']);
                } catch (\Illuminate\Database\QueryException $e) {
                    // Tangkap pesan error STATE 45000 dari trigger/procedure
                    if ($e->getCode() == '45000') {
                        throw ValidationException::withMessages(['cart' => "Stok untuk produk {$buah->nama_buah} tidak mencukupi."]);
                    }
                    throw $e;
                }
            }

            return response()->json(['status' => 'success']);
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
