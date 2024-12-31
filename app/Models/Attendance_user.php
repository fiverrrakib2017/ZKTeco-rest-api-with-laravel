<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_ip',
        'device_name',
        'uid',
        'user_id',
        'name',
        'role',
        'password',
        'cardno',
    ];
}
