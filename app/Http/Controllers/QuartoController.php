<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quarto;
use App\Cama;
use Illuminate\Support\Facades\DB;

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
        $quartos = DB::table('quartos')
            ->select('quartos.id', 'quartos.numero','quartos.andar', 'quartos.status', 'quartos.acessibilidade', 'quartos.banheiro')
            ->distinct()
            ->get();

        $camas = DB::table('camas')
            ->select( 'camas.quarto_id','camas.cama')
            ->distinct()
            ->get();

        $andares = DB::table('quartos')
            ->select('quartos.andar')
            ->distinct()
            ->get();

        $cont = 0;

        return view('quartos/list')->withQuartos($quartos)->withCont($cont)->withCamas($camas)->withAndares($andares);
    }

    public function cadastro()
    {

        return view('quartos/create');
    }

    public function cadastrar(Request $req)
    {
        $data = $req;

        if($data['acessibilidade'] == NULL){
            $data['acessibilidade'] = FALSE;
        }
        else{
            $data['acessibilidade'] = TRUE;
        }

        if($data['banheiro'] == NULL){
            $data['banheiro'] = FALSE;
        }
        else{
            $data['banheiro'] = TRUE;
        }


        $q = Quarto::create([
            'andar' => $data['andar'],
            'numero' => $data['numero'],
            'status' => $data['status'],
            'observacao' => $data['observacao'],
            'banheiro' => $data['banheiro'],
            'acessibilidade' => $data['acessibilidade'],
        ]);

        if($data['berco'] != NULL){
            Cama::create([
                'cama' => "Berço",
                'quantidade' => $data['quantberco'],
                'ocupadas' => 0,
                'quarto_id' => $q['id'],
            ]);
        }

        if($data['bicama'] != NULL){
            Cama::create([
                'cama' => "Bicama",
                'quantidade' => $data['quantbicama'],
                'ocupadas' => 0,
                'quarto_id' => $q['id'],
            ]);
        }

        if($data['camacasal'] != NULL){
            Cama::create([
                'cama' => "Cama Casal",
                'quantidade' => $data['quantcamacasal'],
                'ocupadas' => 0,
                'quarto_id' => $q['id'],
            ]);
        }

        if($data['cama'] != NULL){
            Cama::create([
                'cama' => "Cama Solteiro",
                'quantidade' => $data['quantcamasolteiro'],
                'ocupadas' => 0,
                'quarto_id' => $q['id'],
            ]);
        }

        return redirect()->route('quartos.lista');
    }

    public function filtrar($id){
        $quartos = DB::table('quartos')
            ->select('quartos.id', 'quartos.numero','quartos.andar', 'quartos.status', 'quartos.acessibilidade', 'quartos.banheiro')
            ->where('quartos.andar', $id)
            ->distinct()
            ->get();

        $camas = DB::table('camas')
            ->select( 'camas.quarto_id','camas.cama')
            ->distinct()
            ->get();

        $andares = DB::table('quartos')
            ->select('quartos.andar')
            ->distinct()
            ->get();

        $cont = 0;

        return view('quartos/list')->withQuartos($quartos)->withCont($cont)->withCamas($camas)->withAndares($andares);
    }

    public function edita($id){
        $quarto = DB::table('quartos')
            ->select('id', 'andar','numero', 'status', 'observacao', 'banheiro', 'acessibilidade')
            ->where('id', $id)
            ->distinct()
            ->get()->first();

        $camas = DB::table('camas')
            ->select('id', 'cama','quantidade')
            ->where('quarto_id', $quarto->id)->distinct()
            ->get();


        return view('quartos/edit')->withQuarto($quarto)->withCamas($camas);
    }

    public function editar(Request $req){
        $data = $req;
        $id = $data['id_quarto'];

        if(($data['quantbicama'] == NULL && $data['bicama'] != NULL) || ($data['quantberco'] == NULL && $data['berco'] != NULL) ||
        ($data['quantcamasolteiro'] == NULL && $data['cama'] != NULL) || ($data['quantcamacasal'] == NULL && $data['camacasal'] != NULL)){
            return redirect()->back()->withErrors(['error' => 'A quantidade deve ser preenchida']);
        }
        else {
            $camas = DB::table('camas')
                ->select('id', 'cama', 'quantidade')
                ->where('quarto_id', $id)->distinct()
                ->get();


            if ($data['acessibilidade'] == NULL) {
                $data['acessibilidade'] = FALSE;
            } else {
                $data['acessibilidade'] = TRUE;
            }

            if ($data['banheiro'] == NULL) {
                $data['banheiro'] = FALSE;
            } else {
                $data['banheiro'] = TRUE;
            }

            Quarto::where('id', $id)
                ->update([
                    'andar' => $data['andar'],
                    'numero' => $data['numero'],
                    'status' => $data['status'],
                    'observacao' => $data['observacao'],
                    'banheiro' => $data['banheiro'],
                    'acessibilidade' => $data['acessibilidade'],
                ]);

            foreach ($camas as $cama) {
                if ($cama->cama == "Bicama") {
                    if ($data['bicama'] == NULL) {
                        Cama::where('quarto_id', $id)->where('cama', 'Bicama')->delete();
                    } else {
                        if ($cama->quantidade != $data['quantbicama']) {
                            Cama::where('quarto_id', $id)
                                ->where('cama', 'Bicama')
                                ->update(['quantidade' => $data['quantbicama']]);
                        }
                    }
                }
                if ($cama->cama == "Berço") {
                    if ($data['berco'] == NULL) {
                        Cama::where('quarto_id', $id)->where('cama', 'Berço')->delete();
                    } else {
                        if ($cama->quantidade != $data['quantberco']) {
                            Cama::where('quarto_id', $id)
                                ->where('cama', 'Berço')
                                ->update(['quantidade' => $data['quantberco']]);
                        }
                    }
                }
                if ($cama->cama == "Cama Solteiro") {
                    if ($data['cama'] == NULL) {
                        Cama::where('quarto_id', $id)->where('cama', 'Cama Solteiro')->delete();
                    } else {
                        if ($cama->quantidade != $data['quantcamasolteiro']) {
                            Cama::where('quarto_id', $id)
                                ->where('cama', 'Cama Solteiro')
                                ->update(['quantidade' => $data['quantcamasolteiro']]);
                        }
                    }
                }
                if ($cama->cama == "Cama Casal") {
                    if ($data['camacasal'] == NULL) {
                        Cama::where('quarto_id', $id)->where('cama', 'Cama Casal')->delete();
                    } else {
                        if ($cama->quantidade != $data['quantcamacasal']) {
                            Cama::where('quarto_id', $id)
                                ->where('cama', 'Cama Casal')
                                ->update(['quantidade' => $data['quantcamacasal']]);
                        }
                    }
                }
            }

            foreach ($camas as $cama) {
                $c[] = $cama->cama;
            }
            if ($data['berco'] != NULL) {
                if (!in_array('Berço', $c)) {
                    Cama::create([
                        'cama' => "Berço",
                        'quantidade' => $data['quantberco'],
                        'ocupadas' => 0,
                        'quarto_id' => $id,
                    ]);
                }
            }
            if ($data['bicama'] != NULL) {
                if (!in_array('Bicama', $c)) {
                    Cama::create([
                        'cama' => "Bicama",
                        'quantidade' => $data['quantbicama'],
                        'ocupadas' => 0,
                        'quarto_id' => $id,
                    ]);
                }
            }
            if ($data['cama'] != NULL) {
                if (!in_array('Cama Solteiro', $c)) {
                    Cama::create([
                        'cama' => "Cama Solteiro",
                        'quantidade' => $data['quantcamasolteiro'],
                        'ocupadas' => 0,
                        'quarto_id' => $id,
                    ]);
                }
            }
            if ($data['camacasal'] != NULL) {
                if (!in_array('Cama Casal', $c)) {
                    Cama::create([
                        'cama' => "Cama Casal",
                        'quantidade' => $data['quantcamacasal'],
                        'ocupadas' => 0,
                        'quarto_id' => $id,
                    ]);
                }
            }

            return redirect()->route('quartos.lista');
        }

    }

    public function dadosCama($cama, $id){ //Ajax
        $qtd = DB::table('camas')
            ->select('quantidade')
            ->where('quarto_id', $id)->where('cama', $cama)
            ->distinct()->get();
        return $qtd->first()->quantidade;
    }

    public function show($id){
        $quarto = DB::table('quartos')
            ->select('id', 'andar','numero', 'status', 'observacao', 'banheiro', 'acessibilidade')
            ->where('id', $id)
            ->distinct()
            ->get()->first();

        $camas = DB::table('camas')
            ->select('id', 'cama','quantidade')
            ->where('quarto_id', $quarto->id)->distinct()
            ->get();


        return view('quartos/show')->withQuarto($quarto)->withCamas($camas);
    }
}
