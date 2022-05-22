<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\SecondaryCategory;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;

    public function shop()
    {
        // Ownerモデルと紐づいているか
        return $this->belongsTo(Shop::class);
    }

    public function category()
    {
        // カテゴリモデルと紐づいているか
        return $this->belongsTo(SecondaryCategory::class, 'secondary_category_id');
    }

    
    // imageクラスとのリレーション
    // image1というカラムがあるため、image1()のメソッドは作成できない
    public function imageFirst()
    {
        // imageモデルとリレーション
        return $this->belongsTo(Image::class, 'image1', 'id');
    }
}
