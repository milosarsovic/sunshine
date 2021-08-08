<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Foreach_;
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
    public function categoryProduct ($id){
        $category = Category::where("id", "=", $id)->first();
        if (!$category){
            return response("category not found", 404);

        }
        return response($category->products);

    }
    public function categoryPrice ($id){
        $kategorija = Category::where("id", "=", $id)->first();
        if(!$kategorija){
            return response ("category does not exist",404);

        }

    $ukupnaCena = 0;
        $brojProizvoda = $kategorija->products->count();


        foreach($kategorija->products as $product){
            $ukupnaCena = $ukupnaCena + $product-> price;


        }

        return response($ukupnaCena / $brojProizvoda);


    }

}
