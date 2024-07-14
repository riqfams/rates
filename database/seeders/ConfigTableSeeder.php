<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'app.name' =>'Website',
            'app.url' => 'https://website.com/',
            'mail.from.name' => 'website',
            'mail.from.address' => 'info@website.com',
            'mail.default' => 'smtp',
            'mail.mailers.smtp.host' => 'smtp.gmail.com',
            'mail.mailers.smtp.port' => '587',
            'mail.mailers.smtp.username' => 'akhlakulaziz@gmail.com',
            'mail.mailers.smtp.password' => 'jyastgrehcyxgrfu',
            'mail.mailers.smtp.encryption' => 'ssl',
            'setting.general.app_logo' =>'logo.png',
            'setting.general.app_favicon' =>'favicon.png',
            'setting.general.app_description' =>'test',
        ];
        
        foreach ($data as $key => $value) {
            $config = \App\Models\Config::firstOrCreate(['key' => $key]);
            $config->value = $value;
            $config->save();
        }
    }
}
