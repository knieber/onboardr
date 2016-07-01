<?php

use Illuminate\Database\Seeder;
use Onboardr\Apps\App;

class AppsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App::create([
            'name' => 'GitHub'
        ]);
    }
}
