<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Sponserform;
use App\Models\Payment;

class Guardian extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    use SoftDeletes;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function sponserforms()
    {
     return $this->belongsToMany(Sponserform::class,'guardian_sponserform');

    }

    
}//end of moddel
