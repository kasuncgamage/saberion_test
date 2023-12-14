<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatusEnum;
use App\Http\Requests\ProductRequest;
use App\Models\ProductModel;
use App\Services\ProductService;

class ProductController extends Controller
{
    private $productService;


    public function __construct(ProductService $productService){
        $this->middleware('auth');
        $this->productService = $productService;
    }

    public function index()
    {
        $search_text = "";
        if(request()->has('search') && request()->get('search') !== null){
            $search_text = request()->get('search');
		}
        $products = $this->productService->showAllProducts($search_text);
        $product_status = ProductStatusEnum::LIST;
        return view('product.index', compact(['products','product_status']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create',["product_status" => ProductStatusEnum::LIST]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $products = $this->productService->saveNewProduct($request);
        if($products === true){
            return redirect()->route('products.index')->with('success','Products has been created successfully.');
        }else{
            return redirect()->route('products.index')->with('success','Something went wrong.('.$products.')');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function show(ProductModel $product)
    {
        $attributes_array = [];
        foreach($product->ProAttributes as $val){
            $attributes_array[] = [
                "att_name"=>$val->attribute_name,
                "att_value"=>$val->attribute_value,
            ];
        }
        $attributes_json = json_encode($attributes_array);
        $product_status = ProductStatusEnum::LIST;
        return view('product.show',compact(['product','attributes_json','product_status']));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductModel $product)
    {
        $attributes_array = [];
        foreach($product->ProAttributes as $val){
            $attributes_array[] = [
                "att_name"=>$val->attribute_name,
                "att_value"=>$val->attribute_value,
            ];
        }
        $attributes_json = json_encode($attributes_array);
        $product_status = ProductStatusEnum::LIST;
        return view('product.edit',compact(['product','attributes_json','product_status']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, ProductModel $product)
    {
        $res = $this->productService->updateProduct($product,$request);
        if($res === true){
            return redirect()->route('products.index')->with('success','Product has been updated successfully.');
        }else{
            return redirect()->route('products.index')->with('success','Something went wrong.('.$res.')');
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductModel $product)
    {
        $this->productService->destroyProduct($product);
        return redirect()->route('products.index')->with('success','Product has been deleted successfully');
    
    }
}
