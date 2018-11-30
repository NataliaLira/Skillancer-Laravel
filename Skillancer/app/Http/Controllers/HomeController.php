<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projeto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $projetos = Projeto::orderBy('titulo')->orderBy('id_projeto', 'desc')->take(3)->get();

      return view('home')->with('listaDeProjetos', $projetos);
    }
}
