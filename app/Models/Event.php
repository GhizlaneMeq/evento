<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

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
