<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\stringContains;

class ProductController extends Controller
{
    public function createProduct(Request $request){

        $product = new Product();
        $product->name = $request->json("name");
        $product->price = $request->json("price");
        $product->category_id = $request->json("category")["id"];
        $product->description = $request->json("description");
        $product->lager = $request->json("lager");
        $product->image = $request->json("image");
        $product->currency = "RSD";
        $product->save();

        return response(new ProductResource($product));

    }

    public function uploadImage(Request $request){

        $image = $request->file("image");
        $path = "images";
        $imagePath = Storage::put($path, $image);

        return response($imagePath);

    }
}
