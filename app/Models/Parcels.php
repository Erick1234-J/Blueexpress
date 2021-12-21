<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcels extends Model
{
    use HasFactory;

    protected $fillable = [
        'From',
        'To',
        'ShipDetails',
        'Weight',
        'Phone',
        'Email',
        'FirstName',
        'LastName',
        'Reference',
        'Status',
        'user_id'
    ];

    public $table = 'parcels';

    public function users()
    {
        
            return $this->belongsTo(User::class);
    }
}
