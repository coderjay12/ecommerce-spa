<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Brand;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "==> Seeding Some Values...";
        factory(User::class, 5)->create();
        factory(Category::class, 5)->create();
        factory(Brand::class, 5)->create();
        User::find(1)->update(['email' => 'duwaljyoti16@gmail.com']);
        echo "===> Seeding Done! :)";
    }
}
