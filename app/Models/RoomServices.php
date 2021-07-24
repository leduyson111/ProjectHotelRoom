<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomServices extends Model
{
    use HasFactory;

    protected $table = 'room_services';
    protected $primaryKey = 'id';
    protected $guarded = [];


}
