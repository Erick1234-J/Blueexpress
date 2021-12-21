<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'ManId',
        'Address',
        'Phone',
        'Email',
        'Position'
    ];

    public $table = 'staff';

    public function delivery()
    {
        return $this->hasMany(deliveryteam::class);
    }
}
