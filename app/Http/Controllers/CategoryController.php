<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index() {
        $data = DB::table('categories')->get();
        return view('pages.category.index', compact('data'));
    }

    public function create() {
        return view('pages.category.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_kategori' => 'required|unique:categories'
        ]);

        DB::table('categories')->insert([
            'nama_kategori' => $request->nama_kategori
        ]);


        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }   

    public function edit($id) {
        $data = DB::table('categories')->where('id', $id)->first();
        return view('pages.category.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori,' . $id
        ]);

        DB::table('categories')->where('id', $id)->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }           

    public function destroy($id) {
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
