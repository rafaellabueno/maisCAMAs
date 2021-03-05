<?php

namespace App\Http\Controllers;

use App\Cama;
use App\Pessoa;
use App\Quarto;
use App\Reserva;
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

        $reservas = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('quartos', 'quartos.id', '=', 'reserva_pessoa_quarto.quarto_id')
            ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'reservas.urgencia', 'quartos.numero', 'reservas.acessibilidade', 'reservas.crianca', 'users.name')
            ->where('reserva_pessoa_quarto.pessoa_id', $id)->distinct()
            ->get();


        return view('hospedes/edit')->withHospede($hospede)->withReservas($reservas);
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

    public function editaQuarto($id){
        $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('quartos', 'quartos.id', '=', 'reserva_pessoa_quarto.quarto_id')
            ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'reservas.urgencia', 'quartos.numero', 'reservas.acessibilidade', 'reservas.crianca', 'users.name')
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
            ->join('reservas', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->select('pessoas.id', 'pessoas.nome', 'reserva_pessoa_quarto.quarto_id')
            ->where('reservas.status', 'Aceita')
            ->distinct()->get();

        return view('hospedes.editQuarto')->withReserva($reserva)->withAndares($andares)->withQuartos($quartos)->withCamas($camas)->withHospedes($hospedes);

    }

    public function editarQuarto(Request $req){
        $data = $req;

        Reserva::where('id', $data['id_reserva'])
            ->update([
                'data_saida' => $data['data_saida'],
            ]);


        return redirect()->route('hospedes.quartos', array($data['id_pessoa'], $data['id_reserva'], $data['radio']));
    }
    public function quartos($idPessoa, $idReserva, $idQuarto){
        $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('quartos', 'quartos.id', '=', 'reserva_pessoa_quarto.quarto_id')
            ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'reserva_pessoa_quarto.quarto_id', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca', 'users.name')
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
            ->join('reservas', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->select('pessoas.id', 'pessoas.nome', 'reserva_pessoa_quarto.quarto_id')
            ->where('reservas.status', 'Aceita')
            ->where('reserva_pessoa_quarto.quarto_id', $idQuarto)->distinct()->get();


        $quartoA = DB::table('quartos')
            ->select( 'id', 'numero', 'andar', 'status', 'banheiro', 'acessibilidade')
            ->where('id', $reserva->first()->quarto_id)
            ->distinct()->get();

        $camasA = DB::table('camas')
            ->select( 'id', 'cama', 'quantidade', 'ocupadas', 'quarto_id')
            ->where('quarto_id', $reserva->first()->quarto_id)
            ->distinct()->get();

        $hospedesA = DB::table('pessoas')
            ->join('reserva_pessoa_quarto', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->select('pessoas.id', 'pessoas.nome', 'reserva_pessoa_quarto.quarto_id')
            ->where('reserva_pessoa_quarto.quarto_id', $reserva->first()->quarto_id)->distinct()->get();


        return view('hospedes.bedroom')->withPessoa($idPessoa)->withReserva($reserva)->withQuarto($quarto)->withCamas($camas)->withHospedes($hospedes)->withQuartoA($quartoA)->withCamasA($camasA)->withHospedesA($hospedesA);
    }

    public function quarto(Request $req){
        $data = $req;

        $camasH = DB::table('camas')
            ->join('reserva_pessoa_quarto', 'camas.quarto_id', '=', 'reserva_pessoa_quarto.quarto_id')
            ->select('camas.id', 'camas.cama', 'camas.quarto_id','camas.quantidade', 'camas.ocupadas', 'camas.quarto_id')
            ->where('reserva_pessoa_quarto.pessoa_id', $data['id_pessoa'])
            ->where('reserva_pessoa_quarto.reserva_id', $data['id_reserva'])
            ->distinct()->get();

        $camas = DB::table('camas')
            ->select( 'id', 'cama', 'quantidade', 'ocupadas', 'quarto_id')
            ->where('quarto_id', $data['id_quarto'])
            ->distinct()->get();

        $quarto = null;

        foreach ($camasH as $cama){
            $quarto = $cama->quarto_id;
            if($data['camasolteiroA'] != null && $cama->cama == "Cama Solteiro"){
                $qtd = $cama->ocupadas - $data['camasolteiroA'];
                if($qtd < 0){
                    return redirect()->back()->withErrors(['quantidadeH' => 'As vagas desocupadas não podem assumir esse valor']);
                }
                else{
                    $qtdCSH = $qtd;
                }
            }

            if($data['camacasalA'] != null && $cama->cama == "Cama Casal"){
                if($data['camacasalA'] != null && $cama->cama == "Cama Casal"){
                    $qtd = $cama->ocupadas - $data['camacasalA'];
                    if($qtd < 0){
                        return redirect()->back()->withErrors(['quantidadeH' => 'As vagas desocupadas não podem assumir esse valor']);
                    }
                    else{
                        $qtdCCH = $qtd;
                    }
                }
            }

            if($data['bicamaA'] != null && $cama->cama == "Bicama"){
                if($data['bicamaA'] != null && $cama->cama == "Bicama"){
                    $qtd = $cama->ocupadas - $data['bicamaA'];
                    if($qtd < 0){
                        return redirect()->back()->withErrors(['quantidadeH' => 'As vagas desocupadas não podem assumir esse valor']);
                    }
                    else{
                        $qtdBH = $qtd;
                    }
                }
            }

            if($data['bercoA'] != null && $cama->cama == "Berço"){
                if($data['bercoA'] != null && $cama->cama == "Berço"){
                    $qtd = $cama->ocupadas - $data['bercoA'];
                    if($qtd < 0){
                        return redirect()->back()->withErrors(['quantidadeH' => 'As vagas desocupadas não podem assumir esse valor']);
                    }
                    else{
                        $qtdBeH = $qtd;
                    }
                }
            }
        }

        foreach ($camas as $cama){
            if($data['camasolteiro'] != null && $cama->cama == "Cama Solteiro"){
                $qtd = $data['camasolteiro'] + $cama->ocupadas;
                if($qtd > $cama->quantidade){
                    return redirect()->back()->withErrors(['quantidade' => 'As vagas ocupadas ultrapassam o limite do quarto']);
                }
                else{
                    $qtdCS = $qtd;
                }
            }

            if($data['camacasal'] != null && $cama->cama == "Cama Casal"){
                if($data['camacasal'] != null && $cama->cama == "Cama Casal"){
                    $qtd = $data['camacasal'] + $cama->ocupadas;
                    if($qtd > $cama->quantidade){
                        return redirect()->back()->withErrors(['quantidade' => 'As vagas ocupadas ultrapassam o limite do quarto']);
                    }
                    else{
                        $qtdCC = $qtd;
                    }
                }
            }

            if($data['bicama'] != null && $cama->cama == "Bicama"){
                if($data['bicama'] != null && $cama->cama == "Bicama"){
                    $qtd = $data['bicama'] + $cama->ocupadas;
                    if($qtd > $cama->quantidade){
                        return redirect()->back()->withErrors(['quantidade' => 'As vagas ocupadas ultrapassam o limite do quarto']);
                    }
                    else{
                        $qtdB = $qtd;
                    }
                }
            }

            if($data['berco'] != null && $cama->cama == "Berço"){
                if($data['berco'] != null && $cama->cama == "Berço"){
                    $qtd = $data['berco'] + $cama->ocupadas;
                    if($qtd > $cama->quantidade){
                        return redirect()->back()->withErrors(['quantidade' => 'As vagas ocupadas ultrapassam o limite do quarto']);
                    }
                    else{
                        $qtdBe = $qtd;
                    }
                }
            }
        }

        if(isset($qtdCS)){
            Cama::where('cama', "Cama Solteiro")->where('quarto_id', $data['id_quarto'])
                ->update(['ocupadas' => $qtdCS,
                ]);
        }

        if(isset($qtdCC)){
            Cama::where('cama', "Cama Casal")->where('quarto_id', $data['id_quarto'])
                ->update(['ocupadas' => $qtdCC,
                ]);
        }

        if(isset($qtdB)){
            Cama::where('cama', "Bicama")->where('quarto_id', $data['id_quarto'])
                ->update(['ocupadas' => $qtdB,
                ]);
        }

        if(isset($qtdBe)){
            Cama::where('cama', "Berço")->where('quarto_id', $data['id_quarto'])
                ->update(['ocupadas' => $qtdBe,
                ]);
        }

        if(isset($qtdCSH)){
            Cama::where('cama', "Cama Solteiro")->where('quarto_id', $quarto)
                ->update(['ocupadas' => $qtdCSH,
                ]);
        }

        if(isset($qtdCCH)){
            Cama::where('cama', "Cama Casal")->where('quarto_id', $quarto)
                ->update(['ocupadas' => $qtdCCH,
                ]);
        }

        if(isset($qtdBH)){
            Cama::where('cama', "Bicama")->where('quarto_id', $quarto)
                ->update(['ocupadas' => $qtdBH,
                ]);
        }

        if(isset($qtdBeH)){
            Cama::where('cama', "Berço")->where('quarto_id', $quarto)
                ->update(['ocupadas' => $qtdBeH,
                ]);
        }

        DB::table('reserva_pessoa_quarto')->where('reserva_id', $data['id_reserva'])
            ->update(array('quarto_id' => $data['id_quarto']));

        Quarto::where('id', $data['id_quarto'])
            ->update(['status' => $data['status'],
            ]);

        Quarto::where('id', $quarto)
            ->update(['status' => $data['statusA'],
            ]);

        return redirect()->route('hospedes.edita', ['id' => $data['id_pessoa']]);
    }

    public function filtrar($id, $andar)
    {
        $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
            ->join('quartos', 'quartos.id', '=', 'reserva_pessoa_quarto.quarto_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'quartos.numero', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca', 'users.name')
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

        return view('hospedes.editQuarto')->withReserva($reserva)->withAndares($andares)->withQuartos($quartos)->withCamas($camas)->withHospedes($hospedes);
    }

    public function checkout($id){
        $reserva = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('quartos', 'quartos.id', '=', 'reserva_pessoa_quarto.quarto_id')
            ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
            ->select('reservas.id', 'reserva_pessoa_quarto.pessoa_id','pessoas.nome', 'reservas.created_at', 'reservas.status', 'pessoas.cidade', 'pessoas.telefone', 'pessoas.email', 'pessoas.rg', 'reservas.nome_paciente',
                'pessoas.data_nascimento', 'reservas.data_entrada', 'reservas.data_saida', 'reservas.especialidade',
                'reservas.observacao', 'reserva_pessoa_quarto.pessoa_id', 'reserva_pessoa_quarto.quarto_id', 'reservas.urgencia', 'reservas.acessibilidade', 'reservas.crianca', 'users.name')
            ->where('reservas.id', $id)->distinct()
            ->get();

        $quartoA = DB::table('quartos')
            ->select( 'id', 'numero', 'andar', 'status', 'banheiro', 'acessibilidade')
            ->where('id', $reserva->first()->quarto_id)
            ->distinct()->get();

        $camasA = DB::table('camas')
            ->select( 'id', 'cama', 'quantidade', 'ocupadas', 'quarto_id')
            ->where('quarto_id', $reserva->first()->quarto_id)
            ->distinct()->get();

        $hospedesA = DB::table('pessoas')
            ->join('reserva_pessoa_quarto', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->select('pessoas.id', 'pessoas.nome', 'reserva_pessoa_quarto.quarto_id')
            ->where('reserva_pessoa_quarto.quarto_id', $reserva->first()->quarto_id)->distinct()->get();

        return view('hospedes.checkout')->withReserva($reserva)->withQuartoA($quartoA)->withCamasA($camasA)->withHospedesA($hospedesA);
    }

    public function check(Request $req){
        $data = $req;

        $camasH = DB::table('camas')
            ->join('reserva_pessoa_quarto', 'camas.quarto_id', '=', 'reserva_pessoa_quarto.quarto_id')
            ->select('camas.id', 'camas.cama', 'camas.quarto_id','camas.quantidade', 'camas.ocupadas', 'camas.quarto_id')
            ->where('reserva_pessoa_quarto.pessoa_id', $data['id_pessoa'])
            ->where('reserva_pessoa_quarto.reserva_id', $data['id_reserva'])
            ->distinct()->get();


        foreach ($camasH as $cama){
            if($data['camasolteiroA'] != null && $cama->cama == "Cama Solteiro"){
                $qtd = $cama->ocupadas - $data['camasolteiroA'];
                if($qtd < 0){
                    return redirect()->back()->withErrors(['quantidadeH' => 'As vagas desocupadas não podem assumir esse valor']);
                }
                else{
                    $qtdCSH = $qtd;
                }
            }

            if($data['camacasalA'] != null && $cama->cama == "Cama Casal"){
                if($data['camacasalA'] != null && $cama->cama == "Cama Casal"){
                    $qtd = $cama->ocupadas - $data['camacasalA'];
                    if($qtd < 0){
                        return redirect()->back()->withErrors(['quantidadeH' => 'As vagas desocupadas não podem assumir esse valor']);
                    }
                    else{
                        $qtdCCH = $qtd;
                    }
                }
            }

            if($data['bicamaA'] != null && $cama->cama == "Bicama"){
                if($data['bicamaA'] != null && $cama->cama == "Bicama"){
                    $qtd = $cama->ocupadas - $data['bicamaA'];
                    if($qtd < 0){
                        return redirect()->back()->withErrors(['quantidadeH' => 'As vagas desocupadas não podem assumir esse valor']);
                    }
                    else{
                        $qtdBH = $qtd;
                    }
                }
            }

            if($data['bercoA'] != null && $cama->cama == "Berço"){
                if($data['bercoA'] != null && $cama->cama == "Berço"){
                    $qtd = $cama->ocupadas - $data['bercoA'];
                    if($qtd < 0){
                        return redirect()->back()->withErrors(['quantidadeH' => 'As vagas desocupadas não podem assumir esse valor']);
                    }
                    else{
                        $qtdBeH = $qtd;
                    }
                }
            }
        }

        if(isset($qtdCSH)){
            Cama::where('cama', "Cama Solteiro")->where('quarto_id', $data['id_quarto'])
                ->update(['ocupadas' => $qtdCSH,
                ]);
        }

        if(isset($qtdCCH)){
            Cama::where('cama', "Cama Casal")->where('quarto_id', $data['id_quarto'])
                ->update(['ocupadas' => $qtdCCH,
                ]);
        }

        if(isset($qtdBH)){
            Cama::where('cama', "Bicama")->where('quarto_id', $data['id_quarto'])
                ->update(['ocupadas' => $qtdBH,
                ]);
        }

        if(isset($qtdBeH)){
            Cama::where('cama', "Berço")->where('quarto_id', $data['id_quarto'])
                ->update(['ocupadas' => $qtdBeH,
                ]);
        }

        Quarto::where('id', $data['id_quarto'])
            ->update(['status' => $data['statusA'],
            ]);

        Reserva::where('id', $data['id_reserva'])
            ->update(['status' => "Liberada",
                'situacao_quarto' => $data['situacao_quarto'],
            ]);

        return redirect()->route('hospedes.edita', ['id' => $data['id_pessoa']]);
    }
}
