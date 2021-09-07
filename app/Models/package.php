<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    use HasFactory;
    protected $table = 'package';
    protected $fillable = ['package_name', 'month_num', 'package_amount', 'add_by'];
}
