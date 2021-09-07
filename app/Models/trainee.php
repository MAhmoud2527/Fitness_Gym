<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trainee extends Model
{
    use HasFactory;

    protected $table = 'trainees_more_info';
    protected $fillable = ['weight', 'height', 'package_id', 'coach_id', 'more_add_by', 'more_trainee'];
}
