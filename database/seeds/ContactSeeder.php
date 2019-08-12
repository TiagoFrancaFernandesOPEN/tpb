<?php

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')
        ->insert([
            'fname' => 'Tiago',
            'lname' => 'França',
            'email' => 'tiago@tiagofranca.com'
        ]);
        DB::table('contacts')
        ->insert([
            'fname' => 'Jessica',
            'lname' => 'Fernandes',
            'email' => 'jessica@tiagofranca.com'
        ]);
    }
}
