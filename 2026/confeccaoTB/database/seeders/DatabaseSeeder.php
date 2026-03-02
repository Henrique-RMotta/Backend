<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clientes;
use App\Models\Pedido;
use App\Models\Fornecedor;
use App\Models\Estoque;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        Clientes::factory(10)->create();
        // Clientes::factory()->create([
        //     'nome' => 'henrique', 
        //     'cpf' => '1234',
        //     // 'telefone' => '1234',
        //     // 'reserva' => 2,
        //  ]);

        // User::factory()->create([
        //         'name' => 'Confeção heniq',
        //         'email' => 'heniq@confeccao.com',
        // ]);
        Pedido::factory(10)->create();
        Fornecedor::factory(10)->create();
        Estoque::factory(10)->create();
    }
}