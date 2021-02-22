<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funcao;
use App\User;
use App\Jobs\MailUsuarioJob;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UsuarioController extends Controller
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
        $users = User::all(['id', 'name', 'email', 'funcao_id'])->sortBy("name");
        $cont = 0;

        return view('usuarios/list')->withUsers($users)->withCont($cont);
    }

    public function cadastro()
    {
        $funcoes = Funcao::all(['id', 'nome', 'descricao']);

        return view('usuarios/create')->withFuncoes($funcoes);
    }

    public function cadastrar(Request $req)
    {
        $data = $req;
        $dt = new DateTime();
        $password = \Str::lower(\Str::words($data['nome'], 1).$dt->format('Y'));

        if(User::findByEmail($data['email']) == null){
            User::create([
                'name' => $data['nome'],
                'email' => $data['email'],
                'password' => Hash::make($password),
                'funcao_id' => $data['funcao'],
            ]);

            $emailJob = (new MailUsuarioJob($data['nome'], $data['email'], $password))
                ->delay(\Carbon\Carbon::now()->addSeconds(3));
            dispatch($emailJob);

            return redirect()->route('usuarios.lista');
        }
        else{
            return redirect()->back()->withErrors(['email' => 'E-mail já cadastrado']);
        }
    }

    public function edita($id)
    {
        $user = User::find($id);
        $funcoes = Funcao::all(['id', 'nome', 'descricao']);

        return view('usuarios/edit')->withUser($user)->withFuncoes($funcoes);
    }

    public function editar(Request $req)
    {
        $data = $req->all();
        $id = $data['id_user'];

        if(User::findByEmail($data['email']) == null) {
            User::where('id', $id)
                ->update(['name' => $data['nome'],
                    'email' => $data['email'],
                    'funcao_id' => $data['funcao'],
                ]);

            return redirect()->route('usuarios.lista');
        }
        else{
            return redirect()->back()->withErrors(['email' => 'E-mail já cadastrado']);
        }
    }

    public function dadosFuncao($id){ //Ajax
        return Funcao::find($id);
    }

}
