<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function roomservices(){
        return $this->belongsToMany(RoomServices::class, 'room_services', 'room_id','service_id')->withTimestamps();
    }

}
