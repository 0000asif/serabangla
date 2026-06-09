<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Setting::create([
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
            'site_title' => 'My Website',
            'desc' => 'Website description',
            'hotline' => '123456789',
            'time' => '9am - 5pm',
            'mail' => 'info@example.com',
            'copyright' => '© 2025 My Website',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'keyword1, keyword2',
            'facebook_pixel' => '',
            'google_analytics' => '',
            'allow_indexing' => true,
            'custom_header_scripts' => '',
            'custom_footer_scripts' => '',
        ]);
    }
}