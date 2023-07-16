<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMedicine extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'id_medicines', 'id');
    }
}
