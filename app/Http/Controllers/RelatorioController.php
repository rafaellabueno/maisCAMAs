<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use DateTime;

class RelatorioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('master');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }

    public function csvUsers() {

        $filename = "Usuarios+CAMAs.csv";

        $usuarios = DB::table('users')->join('funcoes', 'users.funcao_id', '=', 'funcoes.id')
            ->select('users.id','users.name', 'users.email', 'funcoes.nome')
            ->distinct()
            ->get();

        $handle = fopen($filename, 'w+');
        $usu = utf8_decode('Usuário');
        $func = utf8_decode('Função');
        fputcsv($handle, [$usu, 'E-mail', $func], ';');

        foreach ($usuarios as $u) {

            fputcsv($handle, [
                utf8_decode($u->name),
                $u->email,
                utf8_decode($u->nome),
            ], ';');
        }

        fclose($handle);
        $headers = ['Content-Type' => 'text/csv'];

        return Response::download($filename, $filename, $headers);
    }

    public function csvQuartos() {

        $filename = "QuartosOcupação+CAMAs.csv";

        $quartos = DB::table('quartos')
            ->select( 'id', 'numero', 'andar', 'status', 'banheiro', 'acessibilidade')
            ->distinct()->get();


        $handle = fopen($filename, 'w+');
        $ocu = utf8_decode('Ocupação');
        $hos = utf8_decode('Hóspedes');
        fputcsv($handle, ['Andar','Quarto','Status', 'Camas', $ocu, $hos], ';');

        foreach ($quartos as $quarto) {
            $camas = DB::table('camas')
                ->select( 'id', 'cama', 'quantidade', 'ocupadas', 'quarto_id')
                ->where('quarto_id', $quarto->id)
                ->distinct()->get();

            $c = '';
            $co = '';
            foreach ($camas as $cama){
                $c = $c.$cama->cama.': '.$cama->quantidade.', ';
                $co = $co.$cama->cama.' ocupadas : '.$cama->ocupadas.', ';
            }

            $hospedes = DB::table('pessoas')
                ->join('reserva_pessoa_quarto', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
                ->join('reservas', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
                ->select('pessoas.id', 'pessoas.nome', 'reserva_pessoa_quarto.quarto_id')
                ->where('reservas.status', 'Aprovada')
                ->where('reserva_pessoa_quarto.quarto_id', $quarto->id)
                ->distinct()->get();

            $h = '';
            foreach ($hospedes as $hospede){
                $h = $h.$hospede->nome.', ';
            }

            fputcsv($handle, [
                utf8_decode($quarto->andar),
                $quarto->numero,
                utf8_decode($quarto->status),
                utf8_decode($c),
                utf8_decode($co),
                utf8_decode($h),
            ], ';');
        }

        fclose($handle);
        $headers = ['Content-Type' => 'text/csv'];

        return Response::download($filename, $filename, $headers);
    }

    public function csvHospedesReservas()
    {
        $filename = "HospedesReservas+CAMAs.csv";

        $reservas = DB::table('reservas')->join('reserva_pessoa_quarto', 'reservas.id', '=', 'reserva_pessoa_quarto.reserva_id')
            ->join('pessoas', 'pessoas.id', '=', 'reserva_pessoa_quarto.pessoa_id')
            ->join('users', 'users.id', '=', 'reserva_pessoa_quarto.user_id')
            ->join('quartos', 'quartos.id', '=', 'reserva_pessoa_quarto.quarto_id')
            ->select('pessoas.nome', 'quartos.andar','quartos.numero', 'reservas.status', 'reservas.data_entrada',
                'reservas.data_saida', 'reservas.quant_hospedes', 'users.name')
            ->distinct()
            ->get();


        $handle = fopen($filename, 'w+');
        $quant_hos = utf8_decode('Quantidade de hóspedes');
        $hos = utf8_decode('Hóspede');
        fputcsv($handle, [$hos,'Andar','Quarto','Status Reserva','Data', $quant_hos, 'AS/Func'], ';');

        foreach ($reservas as $reserva) {
            $dE = new DateTime($reserva->data_entrada);
            $dS = new DateTime($reserva->data_saida);
            fputcsv($handle, [
                utf8_decode($reserva->nome),
                $reserva->andar,
                $reserva->numero,
                utf8_decode($reserva->status),
                utf8_decode($dE->format('d/m/Y').' - '.$dS->format('d/m/Y')),
                utf8_decode($reserva->quant_hospedes),
                utf8_decode($reserva->name),
            ], ';');
        }

        fclose($handle);
        $headers = ['Content-Type' => 'text/csv'];

        return Response::download($filename, $filename, $headers);
    }

    public function csvHospedesCidades()
    {
        $filename = "HospedesCidades+CAMAs.csv";

        $hospedes = DB::table('pessoas')
            ->select('pessoas.id', 'pessoas.nome', 'pessoas.cidade')
            ->orderBy('pessoas.cidade')
            ->distinct()->get();

        $handle = fopen($filename, 'w+');
        $hos = utf8_decode('Hóspedes');
        fputcsv($handle, [$hos, 'Cidade'], ';');

        foreach ($hospedes as $hospede) {
            fputcsv($handle, [
                utf8_decode($hospede->nome),
                utf8_decode($hospede->cidade),
            ], ';');
        }

        fclose($handle);
        $headers = ['Content-Type' => 'text/csv'];

        return Response::download($filename, $filename, $headers);
    }
}
