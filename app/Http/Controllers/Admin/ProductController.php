<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy("id", "desc")->get();
        return view($this->page. "index", compact("products"));
    }

    private $page = "admin.product.";
    private $redirectTo = "admin.product.index";
}
