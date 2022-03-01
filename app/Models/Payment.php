<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Orphan;
use App\Models\Guardian;
use App\Models\Sponsor;
use App\Models\Sponserform;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    
        
    protected $dates = ['deleted_at'];

    public function orphan()
    {
        return $this->belongsTo(Orphan::class);
    }
    public function guardian() 
    {
     return $this->belongsTo(Guardian::class);
    } 
    public function sponserform()
    {
         return $this->belongsTo(Sponserform::class);
    } 



}//end of model
