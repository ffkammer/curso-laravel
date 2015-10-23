<?php

use Illuminate\Database\Seeder;

class OAuthClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'name' => 'AppAngularJS',
            'id' => 'appid1',
            'secret' => 'secret',
        ]);
    }
}
