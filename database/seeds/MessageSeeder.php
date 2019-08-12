<?php

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')
        ->insert([
            'contact_id' => '1',
            'subject' => 'Assunto Teste 1 para contato 1',
            'message' => 'Aqui Vai minha mensagem para o contato id 1'
        ]);

        DB::table('messages')
        ->insert([
            'contact_id' => '1',
            'subject' => 'Assunto Teste 2 para contato 1',
            'message' => 'Aqui Vai minha mensagem #2 para o contato id 1'
        ]);

        DB::table('messages')
        ->insert([
            'contact_id' => '1',
            'subject' => 'Assunto Teste 3 para contato 1',
            'message' => 'Aqui Vai minha mensagem #3 para o contato id 1'
        ]);

        DB::table('messages')
        ->insert([
            'contact_id' => '2',
            'subject' => 'Assunto Teste 1 para contato 2',
            'message' => 'Aqui Vai minha mensagem #1 para o contato id 2'
        ]);

        DB::table('messages')
        ->insert([
            'contact_id' => '2',
            'subject' => 'Assunto Teste 2 para contato 2',
            'message' => 'Aqui Vai minha mensagem #2 para o contato id 2'
        ]);
    }
}
