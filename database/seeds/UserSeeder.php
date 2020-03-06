<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = "Admin";
        $admin->email = "admin@test.loc";
        $admin->password = Hash::make("password");
        $admin->save();
        factory(\App\User::class, 15)->create()
            ->each(function ($user) {
                $sections = App\Section::all();
                $user->sections()
                    ->attach(
                        $sections->random(3)
                            ->pluck('id')
                            ->toArray()
                    );
            });
    }
}
