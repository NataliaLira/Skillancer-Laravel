<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Projeto;
use App\User;

class ProjetosfreelaController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

  public function exibirTodosProjetos() {
    $projetos = Projeto::orderBy('id_projeto', 'desc')->paginate(12);

    return view('projetos_freela')->with('listaDeProjetos', $projetos);
  }

  public function novo() {
    return view('projetos_freela');
  }


  public function aplicarProjeto(){
    return view('projetosfreela_aplicar');
  }

// public function enviarProjeto(){
//   $projeto = Projeto::find($id);
//    return view('projetosfreela/aplicar')->with('projeto', $projeto);
// }

 // public function adicionarProjeto(Request $request) {
 //    $request->validate([
 //     'titulo' => 'unique:projeto,id_projeto|max:200'
 //    ]);
 //
 //    $arquivo = $request->file('arquivo');
 //    if (empty($arquivo)) {
 //      abort(400, 'Nenhum arquivo foi enviado');
 //    }
 //    // salvando
 //    $nomePasta = 'uploads';
 //    $arquivo->storePublicly($nomePasta);
 //    $caminho = public_path()."\\storage\\$nomePasta";
 //    $nomeArquivo = $arquivo->getClientOriginalName();
 //   // movendo
 //    $arquivo->move($caminho, $nomeArquivo);
 //
 //    $fotoUrl = "/storage/uploads/".$nomeArquivo;
 //
 //    $projeto = Projeto::create([
 //      'titulo'=> $request->input('titulo'),
 //      'tipo_servico'=> $request->input('tipo_servico'),
 //      'descricao'=> $request->input('descricao'),
 //      'imagem_url'=> $fotoUrl,
 //      'fk_id_freelancer'=> $request->input('fk_id_freelancer'),
 //      'fk_idPagamento'=> $request->input('fk_idPagamento'),
 //      'fk_idUser'=> Auth::id()
 //    ]);
 //
 //    $projeto->save();
 //
 //      return redirect('/freela_todos');
 //    }
 //
 //  public function editarProjeto($id) {
 //    $projeto = Projeto::find($id);
 //    return view('projetos_freela_editar')->with('projeto', $projeto);
 //  }
 //
 //  public function receberAlteracoes(Request $request, $id){
 //    $request->validate([
 //      'titulo' => 'required|min:2|max:20|unique:projeto'
 //   ]);
 //
 //    $projeto = Projeto::find($id);
 //    $projeto->titulo = $request->input('titulo');
 //    $projeto->save();
 //
 //    return redirect('/freela_todos');
 //  }
 //
 //  public function excluir($id) {
 //    $projeto = Projeto::find($id);
 //    return view('projetos_freela_deletar')->with('projeto', $projeto);
 //  }
 //
 //  public function excluirProjeto($id){
 //    $projeto = Projeto::find($id);
 //    $projeto->delete();
 //
 //    return redirect('/freela_todos');
 //  }
 //

  public function exibirProjeto($id){
    $projeto = Projeto::find($id);
    $cliente = User::find($projeto->fk_idUser);
    return view('projeto_id')->with('projeto', $projeto)->with('cliente', $cliente->name);
  }

}