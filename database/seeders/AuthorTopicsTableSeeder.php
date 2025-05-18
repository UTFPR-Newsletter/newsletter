<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthorTopicsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('author_topics')->insert([
            [
                'att_id'        => 1,
                'att_name'      => 'Desenvolvimento',
                'att_color'     => null,
                'author_aut_id' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'att_id'        => 2,
                'att_name'      => 'Mercado de Trabalho',
                'att_color'     => null,
                'author_aut_id' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}
