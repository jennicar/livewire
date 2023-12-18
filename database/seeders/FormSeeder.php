<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FormSeeder extends Seeder
{
    public function run()
    {
        DB::table('forms')->insert([
            'label' => 'Contact Request',
            'system_name' => 'contact-request',
            'notify_emails' => json_encode(['admin@bythepixel.com']),
        ]);
    }
}
