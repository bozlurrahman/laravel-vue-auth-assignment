<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Illuminate\Support\Facades\Schema;
use App\Models\Company\Rosters;
use App\User;
use Laracasts\TestDummy\Factory as TestDummy;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        // php artisan db:seed --class=UsersTableSeeder
        
        Schema::disableForeignKeyConstraints();
        // DB::table('company_divisitions')->truncate();
        User::truncate();
        Factory(User::class, 20)->create();
    }
}
