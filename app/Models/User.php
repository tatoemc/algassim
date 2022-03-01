<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Orphan;
use App\Models\Sponserform;
use App\Models\Guardian;
use App\Models\Sponsor;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    use HasRoles;

   
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles_name' => 'array',
    ];

    public function orphans()
    {
        return $this->hasMany(Orphan::class);
    }
    
    public function guardian()
    {
        return $this->hasOne(Guardian::class);
    }
    public function sponsor()
    {
        return $this->hasOne(Sponsor::class);
    }






}//end of controller
