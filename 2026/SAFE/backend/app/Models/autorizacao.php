<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class autorizacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'AUT_alunoname',
        'AUT_alunoclass',
        'AUT_type',
        'AUT_nameaqv',
        'AUT_signature_name',
        'AUT_teacher_email',
        'AUT_fouls',
        'AUT_time'
    ];

    public function portaria()
    {
        return $this->hasOne(portaria::class, 'AUT_ID');
    }
}
