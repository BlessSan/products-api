<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
      $pagination = $request->has('paginate') ? $request->paginate : $pagination = 5;
      $orderBy = $request->has('orderBy') ? $request->orderBy : 'id';
      $direction = $request->has('direction') ? $request->direction : 'asc';
      $products = Product::orderBy($orderBy, $direction)->paginate($pagination);

      return response()->json([
        'products'=> $products
      ], 200);
    }

    public function show(Request $request, $category)
    {
      $value = $request->value;
      $orderBy = $request->has('orderBy') ? $request->orderBy : 'id';
      $direction = $request->has('direction') ? $request->direction : 'asc';
      $product = Product::where($category, $value)
                        ->orderBy($orderBy, $direction)
                        ->get();
      return $product;
    }

    public function create(Request $request)
    {
      $request->validate([
        'image'=>'required|url',
        'name'=>'required',
        'description'=>'required',
        'price'=>'required|Integer',
        'quantity'=>'required|Integer'
      ]);

      Product::create($request->all());

      return redirect()->action([ProductController::class,"index"])->with('success','Product added');
    }

    public function update(Request $request, Product $product)
    {
      $product->update($request->all());

      return response()->json($product, 200);
    }

    public function delete(Product $product)
    {
      $product->delete();

      return response()->json(null, 204);
    }
}
