<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductView extends Controller
{
    protected $table = DB::table('vw_product')->get();

    public function index()
    {
        return view('product', [
            'product' => $this->table
        ]);
    }
}
