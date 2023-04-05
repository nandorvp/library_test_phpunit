<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
   protected $guarded = [];

   public function path() {
       return '/books/' . $this->id;
   }

    public function checkout($user) {
        $this->reservations()->create([
            'user_id' => $user->id,
            'checked_out_at' => now()
        ]);
    }

    public function returned($user) {
       $reservation = $this->reservations()->where('user_id',$user->id)
            ->whereNotNull('checked_in_at')
            ->whereNull('returned_at')
            ->first();

       if(is_null($reservation)) {
           throw new \Exception();
       }

       $reservation->update([
           'returned_at' => now(),
       ]);

    }

    public function setAuthorIdAttribute($author)
    {
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name' => $author,

        ]))->id;
    }

    public function  reservations() {
       return $this->hasMany(Reservation::class);
    }

}
