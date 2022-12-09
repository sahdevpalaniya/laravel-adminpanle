<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    // protected $table="states";

    public function contry()
    {
        return $this->belongsTo(Contry::class, 'country_id');
    }
}
