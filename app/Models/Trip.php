<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    use HasFactory;


    protected $guarded = [];


    public function driver(){
        return $this->belongsTo(Driver::class);

    }

    public function user(){
        return $this->BelongsTo(User::class);
    }
}
