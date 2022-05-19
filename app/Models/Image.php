<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // imageテーブルの内容
    protected $fillable = [
        'owner_id',
        'filename',
    ];

}
