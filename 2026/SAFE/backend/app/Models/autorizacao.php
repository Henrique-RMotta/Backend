<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class autorizacao extends Model
{
    public $fillable = ['AUT_alunoname','AUT_alunoclass','AUT_type','AUT_nameaqv','AUT_signature_image','AUT_fouls','AUT_time'];
}
