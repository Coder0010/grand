<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MKamelMasoud\Ads\Models\Ad;
use MKamelMasoud\CoreConfig\Database\Seeders\ResetDBSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Ad::factory(2)->freeType()->create();
        Ad::factory(2)->paidType()->create();
    }
}
