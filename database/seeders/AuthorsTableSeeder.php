<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('authors')->insert([
            // se a tabela estiver vazia, você pode omitir o aut_id
            'aut_id'    => 1,
            'aut_name'  => 'Felipe Kurt Pohling',
            'aut_cpf'   => '42981376861',
            'aut_photo' => 'dev_kurt.jpg',
            'aut_body'  => '📖 Diretor de Ensino e Pesquisa @ CASIS-FB<br>💻 Desenvolvedor FullStack @ Imaxis<br>🧠 Espelista em Laravel e TailwindCSS',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
    }
}
