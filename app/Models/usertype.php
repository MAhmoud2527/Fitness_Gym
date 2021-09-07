<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usertype extends Model
{
    use HasFactory;
    protected $table = 'usertype';
    protected $fillable = ['title'];
}
