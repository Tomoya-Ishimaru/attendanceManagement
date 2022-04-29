<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class daytimestamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'punchIn',
        'punchOut',
        'date',
        'd_total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
