<?php

use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('phones')
        ->insert([
            'contact_id' => '1',
            'number' => '41 98440-2684',
            'type' => 'mobile',
            'apps' => 'tg, wa'
        ]);

         DB::table('phones')
        ->insert([
            'contact_id' => '2',
            'number' => '41 98506-0000',
            'type' => 'mobile',
            'apps' => 'wa'
        ]);       

         DB::table('phones')
        ->insert([
            'contact_id' => '1',
            'number' => '41 3024-2660',
            'type' => 'home',
            'apps' => 'wa'
        ]);       
    }
}
