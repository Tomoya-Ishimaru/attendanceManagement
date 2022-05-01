<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Daytimestamp;

class stampCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'daytimestamp_id',
        'newPunchIn',
        'newPunchOut'
        
    ];
    public function daytimestamp()
    {
        return $this->belongsTo(Daytimestamp::class);
    }
}
