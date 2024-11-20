<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $tasks = [
            [
                'title' => 'Comprar ingredientes para o jantar',
                'description' => 'Ir ao mercado e comprar os ingredientes necessários para o jantar de hoje.',
                'status' => 'pending',
                'user_id' => User::inRandomOrder()->first()->id,
            ],
            [
                'title' => 'Limpar a casa',
                'description' => 'Realizar a limpeza geral da casa, incluindo aspirar os carpetes e limpar os banheiros.',
                'status' => 'in_progress',
                'user_id' => User::inRandomOrder()->first()->id,
            ],
            [
                'title' => 'Pagar contas de água e luz',
                'description' => 'Efetuar o pagamento das contas de água e luz antes do vencimento.',
                'status' => 'completed',
                'user_id' => User::inRandomOrder()->first()->id,
            ],
            [
                'title' => 'Responder e-mails de trabalho',
                'description' => 'Verificar e responder e-mails importantes relacionados ao trabalho.',
                'status' => 'pending',
                'user_id' => User::inRandomOrder()->first()->id,
            ],
            [
                'title' => 'Estudar para o exame de matemática',
                'description' => 'Dedicar 2 horas ao estudo de matemática para o exame da próxima semana.',
                'status' => 'in_progress',
                'user_id' => 2,
            ],
            [
                'title' => 'Fazer compras online',
                'description' => 'Comprar novos itens de vestuário e eletrônicos que estão em promoção online.',
                'status' => 'pending',
                'user_id' => User::inRandomOrder()->first()->id,
            ],
            [
                'title' => 'Organizar arquivos de trabalho',
                'description' => 'Organizar os arquivos no computador e no Google Drive para facilitar o acesso.',
                'status' => 'completed',
                'user_id' => 2,
            ],
            [
                'title' => 'Fazer o almoço',
                'description' => 'Preparar o almoço para a família, incluindo arroz, feijão e carne.',
                'status' => 'completed',
                'user_id' => User::inRandomOrder()->first()->id,
            ],
            [
                'title' => 'Lavar roupa',
                'description' => 'Colocar as roupas na máquina de lavar e depois estendê-las para secar.',
                'status' => 'pending',
                'user_id' => User::inRandomOrder()->first()->id,
            ],
            [
                'title' => 'Ligar para o médico',
                'description' => 'Agendar uma consulta com o médico para o check-up anual.',
                'status' => 'in_progress',
                'user_id' => User::inRandomOrder()->first()->id,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}

