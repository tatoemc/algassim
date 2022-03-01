<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Sponserform;
use App\Models\Payment;

class Orphan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sponserform()
    {
        return $this->hasOne(Sponserform::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    
}//end of model
