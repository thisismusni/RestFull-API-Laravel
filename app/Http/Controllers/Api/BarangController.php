<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Http\Resources\BarangResource;

class BarangController extends Controller
{
    public function index()
    {
        $posts = Barang::latest()->paginate(5);
        return new BarangResource(true, 'List Data Barang', $posts);
    }
}