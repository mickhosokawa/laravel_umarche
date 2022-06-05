<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Cart extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'product_id',
        'quantity'
    ];

    public function products()
    {
    return $this->belongsToMany(Product::class, 'carts')
    ->withPivot(['id', 'quantity']);
    // 第2引数で中間テーブル名
    // 中間テーブルのカラム取得
    // デフォルトでは関連付けるカラム(user_idとproduct_id)のみ取得
    }
}
