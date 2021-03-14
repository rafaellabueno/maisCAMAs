<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;

class HomeController extends Controller
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
        $ano = date("Y");
        $reservas = DB::table('reservas')
            ->select('reservas.id','reservas.status',
             'reservas.data_entrada', 'reservas.data_saida',
               'reservas.quant_hospedes')
            ->whereYear('reservas.data_saida', $ano)
            ->where('reservas.status', "Liberada")
            ->orWhere('reservas.status', "Aprovada")->distinct()
            ->get();
        $ar = ['01' => 0, '02' => 0, '03' => 0, '04' =>0, '05' => 0, '06' =>0, '07' =>0, '08' => 0, '09' => 0, '10' => 0,
            '11' => 0, '12' => 0];

        $ar2 = ['01' => 0, '02' => 0, '03' => 0, '04' =>0, '05' => 0, '06' =>0, '07' =>0, '08' => 0, '09' => 0, '10' => 0,
            '11' => 0, '12' => 0];

        foreach ($reservas as $r){

            $data = new DateTime($r->data_entrada);
            $dataS = new DateTime($r->data_saida);

            $ar2[$data->format('m')] = $ar2[$data->format('m')] + $r->quant_hospedes;

            if($data->format('m') != $dataS->format('m')){
                $dias = cal_days_in_month(CAL_GREGORIAN, $data->format('m'), $ano);
                $ar[$data->format('m')] = $ar[$data->format('m')] + (($dias - $data->format('d')) * $r->quant_hospedes);
                $mes = $data->format('m');
                $mes = $data->add(new DateInterval('P1M'));
                while ($mes->format('m') != $dataS->format('m')){
                    $dias = cal_days_in_month(CAL_GREGORIAN, $mes->format('m'), $ano);
                    $ar[$mes->format('m')] = $ar[$mes->format('m')] + ($dias  * $r->quant_hospedes);
                    $mes = $data->add(new DateInterval('P1M'));
                }
                $ar[$dataS->format('m')] = $ar[$dataS->format('m')] + ($dataS->format('d') * $r->quant_hospedes);
            }
            else{
                $ar[$data->format('m')] = $ar[$data->format('m')] + (($dataS->format('d') - $data->format('d')) * $r->quant_hospedes);
            }
        }
        return view('home')->withAno($ano)->withAr($ar)->withAr2($ar2);
    }
}
