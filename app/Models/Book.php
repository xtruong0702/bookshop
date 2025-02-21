<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Cho phép gán dữ liệu hàng loạt
    protected $fillable = ['title', 'author', 'price', 'image'];
}
