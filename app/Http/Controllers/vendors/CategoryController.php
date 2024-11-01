<?php

namespace App\Http\Controllers\vendors;

use App\Http\Controllers\Controller;
use App\Models\Vendor;

class CategoryController extends Controller
{
    public function show(Vendor $vendor,string $category){
        dd(func_get_args());
    }
}
