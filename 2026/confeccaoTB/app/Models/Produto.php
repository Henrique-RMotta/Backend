<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Produto extends Model
{
    use HasFactory;
    protected $table = "Produtos";
    protected $fillable = ['PR_nome','PR_descricao','PR_preco'];
}
