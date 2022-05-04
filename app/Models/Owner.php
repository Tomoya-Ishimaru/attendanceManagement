<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Corporation;
class Owner extends Authenticatable
{
    use HasFactory, SoftDeletes;
    

    protected $fillable = [
        'name',
        'corporation_id',
        'email',
        'password',
    ];

    public function corporation()
    {
        return $this->belongsTo(Corporation::class);
    }
}
