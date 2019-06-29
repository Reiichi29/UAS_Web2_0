<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\product_reviews;
use Auth;
use Image;

class ProductController extends Controller
{
  public function __construct(){
    $this->middleware('auth', ['except' => ['index', 'show']]);
    $this->model = new Products;

  }

  public function index(Request $request){ 
        $productInstance= new Products();
        $products = $productInstance->orderProducts($request->get('order_by'));
        if($request->ajax()){
            return response()->json($products, 200);
        }
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($products);
        $perPage = 8;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());
      return view('products.index', ['products' => $paginatedItems]);
  }

  public function show($id){
    $product = Products::find($id);
    // if ($product) {
      $product->view++;
      $product->save();
    // }
    $rating = product_reviews::rating($id);
    $reviews = product_reviews::where('product_id', $id)->get();
    if($product){
      return view('products.show', compact('product', 'images', 'reviews', 'rating'));
  } else {
      return redirect('/products')->with('errors', 'Produk tidak ditemukan');
  }
  }

  public function image($imageName){
    $filePath = public_path(env('PATH_IMAGE').'products/'.$imageName);
    return Image::make($filePath)->response();

  }
  public function store(Request $request)
  {
      var_dump($request->ajax());
      die();
      $this->validate(request(),[
          'rating' => 'required',
          'description' => 'required',
      ]);

      $rating = new product_reviews();
      $rating->product_id = $request->product_id;
      $rating->user_id = Auth::user()->id;
      $rating->rating = $request->rating;
      $rating->description = $request->description;
      $rating->save();
      if($request->ajax()){
        return response()->json($rating, 200);
      }

      return redirect(route('product.show', ['id' => $request->product_id]))->with('success', 'Produk berhasil di simpan');
      //return response()->json($rating, 200);
  }
}
