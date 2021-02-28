<?php

namespace App\Http\Controllers;

use App\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HospedeController extends Controller
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
        $hospedes = DB::table('pessoas')
            ->select('id','nome', 'cidade','email', 'rg')
            ->distinct()
            ->orderBy('nome')
            ->get();

        $cont = 1;

        return view('hospedes/list')->withHospedes($hospedes)->withCont($cont);
    }

    public function show($id){
        $hospede = DB::table('pessoas')
            ->select('pessoas.nome', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg',
                'pessoas.data_nascimento')
            ->where('pessoas.id', $id)->distinct()
            ->get();


        return view('hospedes/show')->withHospede($hospede);
    }

    public function edita($id){
        $hospede = DB::table('pessoas')
            ->select('pessoas.id','pessoas.nome', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg',
                'pessoas.data_nascimento')
            ->where('pessoas.id', $id)->distinct()
            ->get();


        return view('hospedes/edit')->withHospede($hospede);
    }

    public function editar(Request $req){
        $data = $req;
        $id = $data['id_hospede'];

        Pessoa::where('id', $id)
            ->update([
                'cidade' => $data['cidade'],
                'data_nascimento' => $data['data'],
                'email' => $data['email'],
                'telefone' => $data['telefone'],
            ]);

        return redirect()->route('hospedes.lista');
    }
}
