<?php

namespace Database\Seeders\icon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IconTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('icons')->insert([
            'id' => '1',
            'user_id' => null,
            'source' => 'http://127.0.0.1:8001/storage/images/Ge05eLPrrBczcQ2bJI0PQFpd7VsQzUvoigFIWvA2.svg',
            'name' => 'folder-svgrepo-com.svg'
        ]);
    }
}
