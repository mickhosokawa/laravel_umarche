<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use InterventionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadImageRequest;
use App\Service\ImageService;

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
        return view('owner.shop.index', compact('shops'));
    }

    public function edit($id)
    {
        // shopidを取得
        $shop = Shop::findOrFail($id);

        return view('owner.shop.edit', compact('shop'));

        // dd(Shop::findOrFail($id));
    }
    /**
     * UploadImageRequestを利用
     */
    public function update(UploadImageRequest $request, $id)
    {
        // 画像ファイルをアップロードする
        $imageFile = $request->image;
        
        // ファイルが指定されていて、
        if(!is_null($imageFile) && $imageFile->isValid()){
            // Storage::putFile('public/shops', $imageFile); // リサイズしない場合

            $fileNameToStore = ImageService::upload($imageFile, 'shops');
        }

        return redirect()->route('owner.shops.index');

    }



}
