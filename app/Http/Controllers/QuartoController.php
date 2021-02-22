<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quarto;

class QuartoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $quartos = Quarto::all(['id', 'andar', 'descricao', 'numero', 'status', 'cama', 'observacao'])->sortBy("numero");
        $cont = 0;

        return view('quartos/list')->withQuartos($quartos)->withCont($cont);
    }

    public function cadastro()
    {

        return view('quartos/create');
    }
}
