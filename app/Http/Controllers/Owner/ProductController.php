<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use App\Models\Product;
use App\Models\PrimaryCategory;
use App\Models\Owner;
use App\Models\Shop;


class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:owners');
        
        // ログインしているユーザ以外が違うショップにログインするのを防ぐ処理
        $this->middleware(function($request, $next){ 
            $id = $request->route()->parameter('product'); 
            if(!is_null($id)){ 
            $productOwnerId = Product::findOrFail($id)->shop->owner->id;
                $productId = (int)$productOwnerId; 
                if($productId !== Auth::id()){ 
                    abort(404);
                } 
            } 
            return $next($request); 
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ログインしているオーナーのプロダクトを表示する
        // 取得したオーナーID→shopモデル→プロダクトを特定する
        //$products = Owner::findOrFail(Auth::id())->shop->product;

       $ownerInfo = Owner::with('shop.product.imageFirst')->where('id', Auth::id())->get();

        //dd($ownerInfo);
        // foreach($ownerInfo as $owner){
        //     // dd($owner->shop->product);
        //     foreach($owner->shop->product as $product){
        //         dd($product->imageFirst->filename);
        //     }
        // }

        // オーナーのプロダクトを表示する
        return view('owner.products.index', compact('ownerInfo'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = Shop::where('Owner_id', Auth::id())
        ->select('id', 'name')
        ->get();

        $images = Image::where('owner_id', Auth::id())
        ->select('id', 'title', 'filename')
        ->orderBy('updated_at', 'desc')
        ->get();

        $categories = PrimaryCategory::with('secondary')
        ->get();

        return view('owner.products.create', compact(['shops', 'images', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}