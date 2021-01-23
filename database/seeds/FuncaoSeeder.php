<?php

use Illuminate\Database\Seeder;
use App\Funcao;

class FuncaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $funcoes = [
            [
                'nome' => 'Master',
                'descricao' => 'O usuário Mater tem acesso a todas as funcionalidades do sistema',
            ],
            [
                'nome' => 'Assistente Social Santa Casa',
                'descricao' => 'O usuário Assistente Social da Santa Casa tem acesso a aba de solicitação de reserva',
            ],
            [
                'nome' => 'Assistente Social Casa de Apoio',
                'descricao' => 'O usuário Assistente Social da Casa de Apoio Madre Ana tem acesso a todas as funcionalidades do sistema, exceto a aba de funções de usuários',
            ],
            [
                'nome' => 'Funcionario Casa de Apoio',
                'descricao' => 'O usuário Funcionário da Casa de Apoio Madre Ana tem acesso a aba de reservas e quartos',
            ],
            [
                'nome' => 'Outro',
                'descricao' => 'Usuário inativo',
            ],
        ];

        foreach ($funcoes as $funcao){
            $funcaoEloquent = new Funcao();
            $funcaoEloquent->fill($funcao);
            $funcaoEloquent->save();
        }
    }
}
