<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class portaria extends Model
{
    use HasFactory;

    protected $fillable = ['AUT_ID', 'PORT_validate'];

    public function autorizacao()
    {
        return $this->belongsTo(autorizacao::class, 'AUT_ID');
    }
}
