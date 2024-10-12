<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    // لو انا هتحقق من الادخال في جدولين مختلفين في الحالة دي لازم اعمل guard جديد
    // prodiver
    use HasFactory, Notifiable;
    protected $fillable = [

        'name',
        'email',
        'password',
        'super_admin',
        'phone_number'

    ];
}
