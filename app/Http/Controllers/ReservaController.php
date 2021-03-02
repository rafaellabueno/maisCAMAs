<?php

namespace App\Http\Controllers;

use App\Notifications\Notificacao;
use App\Reserva;
use App\User;
use App\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Jobs\MailRecusaJob;

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
            'rg' => $data['rg'],
            'email' => $data['email'],
            'telefone' => $data['telefone'],
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
            'paciente' => $data['paciente'],
            'nome_paciente' => $data['nome_paciente'],
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
            'paciente' => $data['paciente'],
            'nome_paciente' => $data['nome_paciente'],
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
            ->select('reservas.id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
            'reservas.observacao', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca')
            ->where('reserva_pessoa_quarto.reserva_id', $id)->distinct()
            ->get();


        return view('reservas/show')->withReserva($reserva);
    }

    public function showPendente($id){
        $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->select('reservas.id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca')
            ->where('reserva_pessoa_quarto.reserva_id', $id)->distinct()
            ->get();


        return view('reservas/showPendente')->withReserva($reserva);
    }

    public function edita($id){
        $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
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
                'rg' => $data['rg'],
                'email' => $data['email'],
                'telefone' => $data['telefone'],
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
                'paciente' => $data['paciente'],
                'nome_paciente' => $data['nome_paciente'],
            ]);

        return redirect()->route('reservas.solicitacoes');
    }

    public function dadosPessoa($rg)
    { //Ajax
        return Pessoa::where([['rg', '=', $rg]])->first();
    }

    public function lista()
    {
        $reservasP = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca', 'users.name')
            ->where('reservas.status', "Solicitada")->distinct()
            ->get();

        $reservasR = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca', 'users.name')
            ->where('reservas.status', "Recusada")->distinct()
            ->get();

        return view('reservas.list')->withReservasP($reservasP)->withReservasR($reservasR);
    }

    public function recusar($id, $s)
    {

        if (password_verify($s, Auth::user()->password)) {
            Reserva::where('id', $id)
                ->update([
                    'status' => "Recusada",
                ]);

            $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
                ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
                ->select('reservas.id', 'users.name', 'users.email')
                ->where('reservas.id', $id)->distinct()
                ->get()->first();

            $emailJob = (new MailRecusaJob($reserva->name, $reserva->email))
                ->delay(\Carbon\Carbon::now()->addSeconds(3));
            dispatch($emailJob);

            return 'true';
        }

        return 'false';
    }

    public function aprovar($id)
    {
        $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca', 'users.name')
            ->where('reservas.id', $id)->distinct()
            ->get();

        $andares = DB::table('quartos')->select( 'andar')->distinct()->get();

        $quartos = DB::table('quartos')
            ->select( 'id', 'numero', 'andar', 'status', 'banheiro', 'acessibilidade')
            ->distinct()->get();

        $camas = DB::table('camas')
            ->select( 'id', 'cama', 'quantidade', 'ocupadas', 'quarto_id')
            ->distinct()->get();


        $hospedes = DB::table('pessoas')
            ->join('reserva_pessoa_quarto', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->select('pessoas.id', 'pessoas.nome', 'reserva_pessoa_quarto.quarto_id')
            ->where('pessoas.id', 'reserva_pessoa_quarto.pessoa_id')->distinct()->get();

        return view('reservas.aprovar')->withReserva($reserva)->withAndares($andares)->withQuartos($quartos)->withCamas($camas)->withHospedes($hospedes);
    }

    public function aprova(Request $req){
        $data = $req;

        Reserva::where('id', $data['id_reserva'])
            ->update(['data_entrada' => $data['data_entrada'],
                'data_saida' => $data['data_saida'],
            ]);


        return redirect()->route('reservas.aprovarQuarto', array($data['id_pessoa'], $data['id_reserva'], $data['radio']));

    }

    public function aprovarQuarto($idPessoa, $idReserva, $idQuarto){

        $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca', 'users.name')
            ->where('reservas.id', $idReserva)->distinct()
            ->get();

        $quarto = DB::table('quartos')
            ->select( 'id', 'numero', 'andar', 'status', 'banheiro', 'acessibilidade')
            ->where('id', $idQuarto)
            ->distinct()->get();

        $camas = DB::table('camas')
            ->select( 'id', 'cama', 'quantidade', 'ocupadas', 'quarto_id')
            ->where('quarto_id', $idQuarto)
            ->distinct()->get();


        $hospedes = DB::table('pessoas')
            ->join('reserva_pessoa_quarto', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->select('pessoas.id', 'pessoas.nome', 'reserva_pessoa_quarto.quarto_id')
            ->where('pessoas.id', 'reserva_pessoa_quarto.pessoa_id')
            ->where('reserva_pessoa_quarto.quarto_id', $idQuarto)->distinct()->get();


        return view('reservas.aprovarQuarto')->withPessoa($idPessoa)->withReserva($reserva)->withQuarto($quarto)->withCamas($camas)->withHospedes($hospedes);
    }

    public function aprovaQuarto(Request $req){

    }

    public function filtrar($id, $andar)
    {
        $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca', 'users.name')
            ->where('reservas.id', $id)->distinct()
            ->get();

        $andares = DB::table('quartos')->select( 'andar')
            ->where('andar', $andar)
            ->distinct()->get();

        $quartos = DB::table('quartos')
            ->select( 'id', 'numero', 'andar', 'status', 'banheiro', 'acessibilidade')
            ->where('andar', $andar)
            ->distinct()->get();

        $camas = DB::table('camas')
            ->join('quartos', 'quartos.id', '=', 'camas.quarto_id')
            ->select( 'camas.id', 'camas.cama', 'camas.quantidade', 'camas.ocupadas', 'camas.quarto_id')
            ->where('quartos.andar', $andar)
            ->distinct()->get();


        $hospedes = DB::table('pessoas')
            ->join('reserva_pessoa_quarto', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('quartos', 'quartos.id', '=', 'reserva_pessoa_quarto.quarto_id')
            ->select('pessoas.id', 'pessoas.nome', 'reserva_pessoa_quarto.quarto_id')
            ->where('pessoas.id', 'reserva_pessoa_quarto.pessoa_id')
            ->where('quartos.andar', $andar)->distinct()->get();

        return view('reservas.aprovar')->withReserva($reserva)->withAndares($andares)->withQuartos($quartos)->withCamas($camas)->withHospedes($hospedes);
    }

}
