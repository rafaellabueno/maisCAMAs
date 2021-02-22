<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\User;
use App\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
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

    public function cadastro()
    {
        return view('reservas/create');
    }

    public function cadastroFunc()
    {
        $pessoas = Pessoa::all(['id','nome', 'rg']);

        return view('reservas/createFunc')->withPessoas($pessoas);
    }

    public function cadastrar(Request $req)
    {
        $data = $req;

        if($data['crianca'] == NULL){
            $data['crianca'] = FALSE;
        }
        else{
            $data['crianca'] = TRUE;
        }

        if($data['acessibilidade'] == NULL){
            $data['acessibilidade'] = FALSE;
        }
        else{
            $data['acessibilidade'] = TRUE;
        }

        if($data['urgencia'] == NULL){
            $data['urgencia'] = FALSE;
        }
        else{
            $data['urgencia'] = TRUE;
        }

        if($data['paciente'] == NULL){
            $data['paciente'] = TRUE;
            $data['nome_paciente'] = NULL;
        }
        else{
            $data['paciente'] = FALSE;
        }

        $p = Pessoa::create([
            'nome' => $data['nome'],
            'cidade' => $data['cidade'],
            'data_nascimento' => $data['data'],
            'paciente' => $data['paciente'],
            'rg' => $data['rg'],
            'email' => $data['email'],
            'telefone' => $data['telefone'],
            'nome_paciente' => $data['nome_paciente'],
        ]);

        $r = Reserva::create([
            'data_entrada' => $data['data_entrada'],
            'data_saida' => $data['data_saida'],
            'especialidade' => $data['especialidade'],
            'observacao' => $data['observacao'],
            'acessibilidade' => $data['acessibilidade'],
            'crianca' => $data['crianca'],
            'status' => "Solicitada",
            'urgencia' => $data['urgencia'],
            'situacao_quarto' => NULL,
        ]);

        DB::table('reserva_pessoa_quarto')
            ->insert([
                'pessoa_id' => $p['id'],
                'reserva_id' => $r['id'],
                'quarto_id' => NULL,
                'user_id' => Auth::user()->id,
            ]);

        return redirect()->route('reservas.solicitacoes');
    }

    public function cadastrarFunc(Request $req)
    {
        $data = $req;

        if($data['crianca'] == NULL){
            $data['crianca'] = FALSE;
        }
        else{
            $data['crianca'] = TRUE;
        }

        if($data['acessibilidade'] == NULL){
            $data['acessibilidade'] = FALSE;
        }
        else{
            $data['acessibilidade'] = TRUE;
        }

        if($data['urgencia'] == NULL){
            $data['urgencia'] = FALSE;
        }
        else{
            $data['urgencia'] = TRUE;
        }

        if($data['paciente'] == NULL){
            $data['paciente'] = TRUE;
            $data['nome_paciente'] = NULL;
        }
        else{
            $data['paciente'] = FALSE;
        }

        $r = Reserva::create([
            'data_entrada' => $data['data_entrada'],
            'data_saida' => $data['data_saida'],
            'especialidade' => $data['especialidade'],
            'observacao' => $data['observacao'],
            'acessibilidade' => $data['acessibilidade'],
            'crianca' => $data['crianca'],
            'status' => "Solicitada",
            'urgencia' => $data['urgencia'],
            'situacao_quarto' => NULL,
        ]);

        $id = Pessoa::where([['email', '=', $data['email']]])->first()->id;

        DB::table('reserva_pessoa_quarto')
            ->insert([
                'pessoa_id' => $id,
                'reserva_id' => $r['id'],
                'quarto_id' => NULL,
                'user_id' => Auth::user()->id,
            ]);

        return redirect()->route('reservas.solicitacoes');
    }

    public function solicitacoes()
    {
        $reservas = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->select('reservas.id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade')
            ->where('reserva_pessoa_quarto.user_id', Auth::user()->id)->distinct()
            ->get()->toArray();

        $cont = 0;


        return view('reservas/solicitacoes')->withReservas($reservas)->withCont($cont);
    }

    public function show($id){
        $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->select('reservas.id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'pessoas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
            'reservas.observacao', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca')
            ->where('reserva_pessoa_quarto.reserva_id', $id)->distinct()
            ->get();


        return view('reservas/show')->withReserva($reserva);
    }

    public function edita($id){
        $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'pessoas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca')
            ->where('reserva_pessoa_quarto.reserva_id', $id)->distinct()
            ->get();


        return view('reservas/edit')->withReserva($reserva);
    }

    public function editar(Request $req){
        $data = $req;
        $idr = $data['id_reserva'];
        $idp = $data['id_pessoa'];

        if($data['crianca'] == NULL){
            $data['crianca'] = FALSE;
        }
        else{
            $data['crianca'] = TRUE;
        }

        if($data['acessibilidade'] == NULL){
            $data['acessibilidade'] = FALSE;
        }
        else{
            $data['acessibilidade'] = TRUE;
        }

        if($data['urgencia'] == NULL){
            $data['urgencia'] = FALSE;
        }
        else{
            $data['urgencia'] = TRUE;
        }

        if($data['paciente'] == NULL){
            $data['paciente'] = TRUE;
            $data['nome_paciente'] = NULL;
        }
        else{
            $data['paciente'] = FALSE;
        }


        Pessoa::where('id', $idp)
            ->update([
                'nome' => $data['nome'],
                'cidade' => $data['cidade'],
                'data_nascimento' => $data['data'],
                'paciente' => $data['paciente'],
                'rg' => $data['rg'],
                'email' => $data['email'],
                'telefone' => $data['telefone'],
                'nome_paciente' => $data['nome_paciente'],
            ]);

        Reserva::where('id', $idr)
            ->update(['data_entrada' => $data['data_entrada'],
                'data_saida' => $data['data_saida'],
                'especialidade' => $data['especialidade'],
                'observacao' => $data['observacao'],
                'acessibilidade' => $data['acessibilidade'],
                'crianca' => $data['crianca'],
                'status' => "Solicitada",
                'urgencia' => $data['urgencia'],
                'situacao_quarto' => NULL,
            ]);

        return redirect()->route('reservas.solicitacoes');
    }

    public function dadosPessoa($rg)
    { //Ajax
        return Pessoa::where([['rg', '=', $rg]])->first();
    }
}
