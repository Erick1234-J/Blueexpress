<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'INumber',
        'Address',
        'Phone',
        'Email',
        'staff_id'
    ];

    public function staffs()
    {
        
            return $this->belongsTo(staff::class);
    }
}
