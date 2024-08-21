<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contents')->insert([
            'title_content' => 'EKSTRA TUTOR ONLINE (EKSTO)',
            'deskripsi' => 'Siswa yang mengalami kendala belajar dapat berkonsultasi melalui chat langsung via WhatsApp dengan tutor sesuai dengan bidang studinya',
        ]);
    }
}
