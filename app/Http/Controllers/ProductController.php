<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
      // products? paginate & orderBy & direction
      $pagination = $request->has('paginate') && !empty($request->paginate) ? $request->paginate : 5;
      $orderBy = $request->has('orderBy') && !empty($request->orderBy) ? $request->orderBy : 'id';
      $direction = $request->has('direction') && !empty($request->direction) ? $request->direction : 'asc';
      $products = Product::orderBy($orderBy, $direction)
                         ->paginate($pagination);
                         

      return $products;
    }

    public function show(Request $request, $category)
    {
      // products/search/{category}? value & orderBy & direction & paginate
      $value = $request->value;
      $pagination = $request->has('paginate') && !empty($request->paginate) ? $request->paginate : 5;
      $orderBy = $request->has('orderBy') && !empty($request->orderBy) ? $request->orderBy : 'id';
      $direction = $request->has('direction') && !empty($request->direction) ? $request->direction : 'asc';
      $product = Product::where($category, $value)
                        ->orderBy($orderBy, $direction)
                        ->paginate($pagination)
                        ->withQueryString();
                        
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
