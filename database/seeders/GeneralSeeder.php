<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('generals')->insert([
            'logo' => '1722823558_logo.png',
            'logo1' => 'stoodee-white.png',
            'logo2' => 'stoodee-white.png',
            'banner' => '1720682806_banner.png',
            'judul' => 'Stoodee Bimbingan Belajar',
            'slogan' => 'LETS STUDY FOR YOUR BRIGHTER FUTURE',
            'judul_content' => 'MENGAPA MEMILIH STOODEE???',
        ]);
    }
}
