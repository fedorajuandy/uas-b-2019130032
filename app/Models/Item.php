<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function orders()
    {
        return $this->hasMany(Order::class, 'order_item');
    }
}
