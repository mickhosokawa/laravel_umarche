<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;

class Image extends Model
{
    use HasFactory;

    // imageテーブルの内容
    protected $fillable = [
        'owner_id',
        'filename',
    ];

    public function owner()
    {
        // Ownerモデルと紐づいているか
        return $this->belongsTo(Owner::class);
    }

}
