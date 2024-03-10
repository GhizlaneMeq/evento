<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Event extends Model 
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 
        'description', 
        'date', 
        'image', 
        'location', 
        'availableSeats', 
        'takenSeats', 
        'status', 
        'reservationMethod', 
        'category_id', 
        'organizer_id'
    ];


    protected $casts = [
        'date' => 'date', 
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
