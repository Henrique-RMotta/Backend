<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Clientes;
class ClienteController extends Controller
{
    public function index() {
        $clientes = Clientes::all();// busca todos os clientes
        return view('clientes.index',compact('clientes'));
    }

    // Exibe o formulário de cadastro (a janela/página de inserção)
    public function create () {
        return view('clientes.create');
    }

    // Recebe os dados do formulário e salva no banco de dados
    public function store (Request $request) {

    // 1. Validação simples para evitar dados vazios ou duplicados
        $request->validate([
            'name' => 'required|string|max:255',
            'cpf'  =>  'required|string|unique:clientes',
            'email' => 'required|email|unique:clientes',
            'telefone' => 'required|string', 
        ]);

        //2. Salva o novo cliente 
        Clientes::create($request->all());

        //3. Redireciona de volta para a lista com uma mensagem de sucesso 
        return redirect()->route('clientes.index')->with('success','Cliente cadastrado com sucesso !');
    }

    public function edit(Clientes $cliente) {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Clientes $cliente) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'cpf'      => 'required|string|unique:clientes,cpf,' . $cliente->id,
            'email'    => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefone' => 'required|string',
        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente Atualizado!');
    }

    public function destroy(Clientes $cliente) {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success','Cliente Removido !');
    }

}
