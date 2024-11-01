<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor;

class HomeProductController extends Controller
{
    public function show(?Vendor $vendor,?Product $product)
    {
        return view('home.products.show' , compact('product','vendor'));
    }
}
