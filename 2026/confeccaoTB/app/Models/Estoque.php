<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Estoque extends Model
{
    use HasFactory;
    protected $table = "estoque";
    protected $fillable = ["ES_nome", "ES_quantidade"];
}
