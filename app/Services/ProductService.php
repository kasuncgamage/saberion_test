<?php
namespace App\Services;

use App\Models\ProductAttributeModel;
use App\Models\ProductModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function showAllProducts($search_text)
    {
        try {
            $query = ProductModel::with(['ProAttributes']);
            if($search_text != ""){
                $query->where('code', 'like', '%' . $search_text . '%');
                $query->orWhere('name', 'like', '%' . $search_text . '%');
            }
            $data = $query->orderBy("id", "DESC")->paginate(10);
            return $data;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function destroyProduct($productModel)
    {
        try {
            $productModel->deleted_at = Carbon::now()->format("Y-m-d H:i:s");
            $productModel->delete();
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function saveNewProduct($request)
    {
        DB::beginTransaction();
        try {
            $product = new ProductModel();
            $product->fill($request->post());
            if ($request->hasFile('product_image')) {
                $img_urls = $this->moveImages($request->file('product_image'));
                $product->image_path = $img_urls;
            }
            $product->save();
            
            // save product attributes
            if($request->pro_attr_array != null || $request->pro_attr_array != ""){
                $pro_attr_array = json_decode($request->pro_attr_array,true);
                $this->addAtributes($pro_attr_array,$product->id);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }



    public function updateProduct($productModel, $request)
    {
        DB::beginTransaction();

        try {
            $request->request->set("updated_at", Carbon::now()->format("Y-m-d H:i:s"));
            $productModel->fill($request->post());
            if ($request->hasFile('product_image')) {
                $img_urls = $this->moveImages($request->file('product_image'));
                $productModel->image_path = $img_urls;
            }
            $productModel->update();

            // save product attributes
            if($request->pro_attr_array != null || $request->pro_attr_array != ""){
                $pro_attr_array = json_decode($request->pro_attr_array,true);
                $this->addAtributes($pro_attr_array,$productModel->id);
            }


            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    private function moveImages($blog_post_image)
    {
        try {
            $imageName = time().'.'.$blog_post_image->extension();
            $blog_post_image->move(public_path('images'), $imageName);
            return $imageName;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function addAtributes($pro_attr_array,$product_id){
        ProductAttributeModel::where("product_id","=",$product_id)->delete();
        foreach($pro_attr_array as $attr){
            ProductAttributeModel::create([
                "product_id"=> $product_id,
                "attribute_name"=> $attr['att_name'],
                "attribute_value"=> $attr['att_value'],
            ]);
        }
    }


}
