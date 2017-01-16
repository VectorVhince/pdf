<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'id' => 1,
            'name' => 'admin',
            'username' => 'admin',
            'role' => 'superadmin',
           	'position' => 'President',
           	'email' => 'admin@admin.com',
           	'password' => bcrypt('adminadmin')
    	]);

        DB::table('pages')->insert([
            'id' => 1,
            'category' => 'about',
            'content' => 'Nothing posted.'
        ]);

        DB::table('pages')->insert([
            'id' => 2,
            'category' => 'terms',
            'content' => 'Nothing posted.'
        ]);

        DB::table('pages')->insert([
            'id' => 3,
            'category' => 'privacy',
            'content' => 'Nothing posted.'
        ]);

        DB::table('pages')->insert([
            'id' => 4,
            'category' => 'weather',
            'content' => 'Nothing posted.'
        ]);

        DB::table('pages')->insert([
            'id' => 5,
            'category' => 'calendar',
            'content' => 'Nothing posted.'
        ]);

        DB::table('pages')->insert([
            'id' => 6,
            'category' => 'selfopinion',
            'content' => 'Nothing posted.'
        ]);

        DB::table('pages')->insert([
            'id' => 7,
            'category' => 'readalso',
            'content' => 'Nothing posted.'
        ]);

        DB::table('pages')->insert([
            'id' => 8,
            'category' => 'fromweb',
            'content' => 'Nothing posted.'
        ]);

        DB::table('pages')->insert([
            'id' => 9,
            'category' => 'outsidesports',
            'content' => 'Nothing posted.'
        ]);
    }
}
