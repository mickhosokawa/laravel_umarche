<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class shopController extends Controller
{
    /**
     * 新しいUserControllerインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:owners');
            //dd($request->route()->parameter('shop')); // 文字列で取得
            //dd(Auth::id()); //数字
        
        // ログインしているユーザ以外が違うショップにログインするのを防ぐ処理
        $this->middleware(function($request, $next){ 
            $id = $request->route()->parameter('shop'); //shopのid取得 
                if(!is_null($id)){ // null判定 
                    $shopsOwnerId = Shop::findOrFail($id)->owner->id; 
                    $shopId = (int)$shopsOwnerId; // キャスト 文字列→数値に型変換 
                    $ownerId = Auth::id(); 
                if($shopId !== $ownerId){ // 同じでなかったら 
                    abort(404); // 404画面表示 
                } 
            } 
            return $next($request); 
        });
    }

    public function index()
    {
        // ログインしているユーザーを取得
        $ownerId = Auth::id();

        // shopモデルでオーナーIDを検索
        $shops = Shop::where('owner_id', Auth::id())->get();

        // 
        return view('owner.shop.index', 
                compact('shops'));
    }

    public function edit($id)
    {
        dd(Shop::findOrFail($id));
    }

    public function update(Request $request, $id)
    {

    }



}
