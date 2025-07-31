<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VotaComunidadeSeeder extends Seeder
{
    public function run()
    {
        // Usuários
        DB::table('usuarios')->insert([
            [
                'id_usuario' => 1,
                'nome' => 'Administrador Geral',
                'email' => 'admin@votacomunidade.com',
                'telefone' => '98999999999',
                'cpf' => '00000000000',
                'senha_hash' => Hash::make('admin123'),
                'tipo_usuario' => 'administrador',
                'status' => 'ativo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_usuario' => 2,
                'nome' => 'Carlos Síndico',
                'email' => 'sindico@condominioazul.com',
                'telefone' => '98988888888',
                'cpf' => '11111111111',
                'senha_hash' => Hash::make('sindico123'),
                'tipo_usuario' => 'sindico',
                'status' => 'ativo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Moradores 3 a 12
            ...collect(range(3, 12))->map(function ($i) {
                return [
                    'id_usuario' => $i,
                    'nome' => "Morador $i",
                    'email' => "morador$i@condominioazul.com",
                    'telefone' => '9890000000' . $i,
                    'cpf' => str_pad($i, 11, '0', STR_PAD_LEFT),
                    'senha_hash' => Hash::make("morador$i"),
                    'tipo_usuario' => 'morador',
                    'status' => 'ativo',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            })->toArray(),
        ]);

        // Condomínio
        DB::table('condominios')->insert([
            'id_condominio' => 1,
            'nome' => 'Condomínio Azul',
            'endereco' => 'Rua das Flores, 123',
            'cidade' => 'São Luís',
            'estado' => 'MA',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Síndico
        DB::table('sindicos')->insert([
            'id_sindico' => 2,
            'id_condominio' => 1,
            'status' => 'ativo',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Moradores (id 3 a 12)
        foreach (range(3, 12) as $i) {
            DB::table('moradores')->insert([
                'id_morador' => $i,
                'id_condominio' => 1,
                'bloco' => chr(64 + ($i - 2)),
                'unidade' => '10' . ($i - 2),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Pauta
        DB::table('pautas')->insert([
            'id_pauta' => 1,
            'id_condominio' => 1,
            'id_sindico' => 2,
            'titulo' => 'Implantação de câmeras de segurança',
            'descricao' => 'Votação para decidir se o condomínio irá instalar câmeras de segurança nas entradas.',
            'data_inicio' => now()->subDays(1),
            'data_fim' => now()->addDays(2),
            'status' => 'ativa',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Opções de voto
        DB::table('opcao_votos')->insert([
            [
                'id_opcao' => 1, 
                'id_pauta' => 1, 
                'descricao' => 'Sim, concordo com a instalação',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_opcao' => 2, 
                'id_pauta' => 1, 
                'descricao' => 'Não, sou contra a instalação',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Votos de 7 moradores (3 a 9)
        $votos = [
            ['id_morador' => 3, 'id_opcao' => 1],
            ['id_morador' => 4, 'id_opcao' => 2],
            ['id_morador' => 5, 'id_opcao' => 1],
            ['id_morador' => 6, 'id_opcao' => 1],
            ['id_morador' => 7, 'id_opcao' => 2],
            ['id_morador' => 8, 'id_opcao' => 1],
            ['id_morador' => 9, 'id_opcao' => 1],
        ];

        foreach ($votos as $index => $voto) {
            DB::table('votos')->insert([
                'id_morador' => $voto['id_morador'],
                'id_pauta' => 1,
                'id_opcao' => $voto['id_opcao'],
                'data_hora_voto' => now()->subMinutes($index * 10),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
