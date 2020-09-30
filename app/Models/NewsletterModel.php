<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NewsletterModel extends Model
{
    use HasFactory;
    use Notifiable;

    public $table = 'newsletter';

    public function routeNotificationForMail($notification)
    {
        // Return email address only...
        return $this->email;

        // Return name and email address...
        //return [$this->email_address => $this->name];
    }
}
