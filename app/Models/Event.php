<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Event extends Model
// {
//     //
// }
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // Add this section:
    protected $fillable = [
        'title',
        'description',
        'venue',
        'event_date',
        'max_capacity',
    ];

    // This ensures Laravel treats the date as a Carbon object
    protected $casts = [
        'event_date' => 'datetime',
    ];
    public function registrations()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(EventNotification::class);
    }
}
