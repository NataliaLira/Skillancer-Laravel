<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projeto;

class ProjetoController extends Controller
{
  public function exibirTodosProjetos() {
    $projetos = Projeto::orderBy('titulo')->paginate(10);

    return view('projeto_todos')->with('listaDeProjetos', $projetos);
  }

  public function novo() {
    return view('projeto_todos');
  }

  public function criarProjeto(){
    return view('projeto_adicionar');
  }

 public function adicionarProjeto(Request $request) {
    $request->validate([
     'titulo' => 'unique:projeto,projeto_id|max:200'
    ]);

    $projeto = Projeto::create([
      'titulo'=> $request->input('titulo'),
      'tipo_servico'=> $request->input('tipo_servico'),
      'descricao'=> $request->input('descricao'),
      'fk_id_freelancer'=> $request->input('fk_id_freelancer'),
      'fk_idPagamento'=> $request->input('fk_idPagamento'),
      'fk_idUser'=> $request->input('fk_idUser')
    ]);

    $projeto->save();
      return redirect('/projeto_todos');
    }

  public function editar($id) {
    $projeto = Projeto::find($id);
    return view('projeto_editar')->with('projeto', $projeto);
  }

  public function receberAlteracoes(Request $request, $id){
    $request->validate([
      'titulo' => 'required|min:2|max:20|unique:projeto'
   ]);

    $projeto = Projeto::find($id);
    $projeto->titulo = $request->input('titulo');
    $projeto->save();

    return redirect('/projeto_todos');
  }

  public function excluir($id) {
    $projeto = Projeto::find($id);
    return view('projeto_deletar')->with('projeto', $projeto);
  }

  public function excluirProjeto(){
    $projeto = Projeto::find($id);
    $projeto->delete();

    return redirect('/projeto_todos');
  }
  public function exibirProjeto($id){
    $projeto = Projeto::find($id);
    return view('projeto_id')->with('projeto', $projeto);
  }
}