<?php

use Illuminate\Database\Seeder;

class SectionSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Section::class, 15)->create();
    }
}
