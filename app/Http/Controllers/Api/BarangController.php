<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Http\Resources\BarangResource;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $posts = Barang::latest()->paginate(5);
        return new BarangResource(true, 'List Data Barang', $posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barcode'   => 'required',
            'nama'      => 'required',
            'departmen' => 'required',
            'uom'       => 'required',
            'stok'      => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = Barang::create($request->all());

        return new BarangResource(true, 'Data Barang Berhasil Ditambahkan!', $post);
    }

    public function show($id)
    {
        $post = Barang::find($id);
        return new BarangResource(true, 'Detail Data Barang!', $post);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'barcode'   => 'required',
            'nama'      => 'required',
            'departmen' => 'required',
            'uom'       => 'required',
            'stok'      => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Barang::find($id);
        $post = $data->update($request->all());

        return new BarangResource(true, 'Data Barang Berhasil Diubah!', $post);
    }

    public function destroy($id)
    {
        $data = Barang::find($id);
        $data->delete();
        
        return new BarangResource(true, 'Data Barang Berhasil Dihapus!', null);
    }
}