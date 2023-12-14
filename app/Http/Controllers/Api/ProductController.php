<?php

namespace App\Http\Controllers\Api;

use App\Enums\ProductStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\ProductModel;
use App\Services\ProductService;
use Faker\Provider\Base;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    private $productService;


    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $search_text = "";
        if (request()->has('search') && request()->get('search') !== null) {
            $search_text = request()->get('search');
        }
        $products = $this->productService->showAllProducts($search_text);
        if ($products !== false) {
            return $this->sendResponse($products, 'Product list');
        } else {
            return $this->sendError("Something went wrong.", [], 400);
        }
    }

    public function store(ProductRequest $request)
    {
        $products = $this->productService->saveNewProduct($request);

        if ($products === true) {
            return $this->sendResponse($products, 'Products has been created successfully');
        } else {
            return $this->sendError('Something went wrong.(' . $products . ')', [], 400);
        }
    }

    public function show(ProductModel $product)
    {
        $attributes_array = [];
        foreach ($product->ProAttributes as $val) {
            $attributes_array[] = [
                "att_name" => $val->attribute_name,
                "att_value" => $val->attribute_value,
            ];
        }
        $data['attributes_json'] = json_encode($attributes_array);
        $data['product_status'] = ProductStatusEnum::LIST;
        $data['product'] = $product;
        return $this->sendResponse($data, 'Products details');
    }

    public function update(ProductRequest $request, ProductModel $product)
    {
        $res = $this->productService->updateProduct($product, $request);
        if ($res === false) {
            return $this->sendError('Something went wrong.(' . $res . ')', [], 400);
        } else {
            return $this->sendResponse($res, 'Product has been updated successfully');
        }
    }


    public function destroy(ProductModel $product)
    {
        $this->productService->destroyProduct($product);
        return $this->sendResponse($product, 'Product has been deleted');
    }
}
