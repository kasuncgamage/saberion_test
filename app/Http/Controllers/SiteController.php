<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogPostResource;
use App\Models\BlogPostModel;
use App\Models\PostTypeModel;
use App\Services\ProductService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(ProductService $productService){
        $allProduct = $productService->showAllProducts("");
        return view('welcome',compact('allProduct'));
    }

}
