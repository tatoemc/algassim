<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Dept extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];
    use SoftDeletes;
    protected $guarded = [];


}//end of model
