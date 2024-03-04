<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'date', 
        'location', 
        'availableSeats', 
        'takenSeats', 
        'status', 
        'reservationMethod', 
        'category_id', 
        'organizer_id'
    ];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
