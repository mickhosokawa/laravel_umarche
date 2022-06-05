<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;
use App\Models\Product;

class Shop extends Model
{
    use HasFactory;

    // shopテーブルの内容
    protected $fillable = [
        'owner_id',
        'name',
        'information',
        'filename',
        'is_selling'
    ];

    public function owner()
    {
        // Ownerモデルと紐づいているか
        return $this->belongsTo(Owner::class);
    }

    public function product()
    {
        // Ownerモデルと紐づいているか
        return $this->hasMany(Product::class);
    }
}
