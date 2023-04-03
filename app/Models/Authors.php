<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $guarded = [];
    protected $casts = ['dob'];

    public function setDobAttribute($dob) {
        $this->attributes['dob'] = Carbon::parse($dob);
    }
}
