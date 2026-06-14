<?php

namespace App\Http\Controllers;

use App\Models\Buah;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori untuk dipasang di menu filter pencarian
        $categories = Kategori::all();

        // Ambil data buah dari VIEW view_detail_buah
        $query = \Illuminate\Support\Facades\DB::table('view_detail_buah');

        // Fitur Filter: Jika pengunjung memilih kategori tertentu
        if ($request->has('category') && $request->category != '') {
            $kategori = Kategori::find($request->category);
            if ($kategori) {
                $query->where('nama_kategori', $kategori->nama_kategori);
            }
        }

        // Fitur Pencarian: Jika pengunjung mengetik nama buah tertentu
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_buah', 'like', '%' . $request->search . '%');
        }

        $fruits = $query->get();

        return view('welcome', compact('categories', 'fruits'));
    }
}
