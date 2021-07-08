<?php

namespace App\Http\Controllers\ClientController;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductPageController extends Controller
{
    public function detail($id)
    {
        $item = Product::find($id);
        return view('frontend.page.product.detail', compact('item'));
    }
}
