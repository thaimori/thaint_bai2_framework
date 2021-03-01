<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        $data = [
            'username' => 'thaint10',
            'password' => bcrypt('123456'),
            'role' => '1',
        ];
        DB::table('user')->insert($data);
    }

}
