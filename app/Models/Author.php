<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $guarded = [];
//  protected $casts = ['dob'=>'date'];

    protected function dob() : Attribute  //
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::create($value)
    );
}


}
