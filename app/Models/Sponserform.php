<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Orphan;
use App\Models\Guardian;
use App\Models\Sponsor;
use App\Models\Payment;

class Sponserform extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function orphan()
    {
        return $this->belongsTo(Orphan::class);
    } 
    public function guardians()
    {
     return $this->belongsToMany(Guardian::class,'guardian_sponserform');

    }
    public function sponsor() 
    {
     return $this->belongsTo(Sponsor::class);
    }  
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    
}//end of model
