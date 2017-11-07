<?php

use Faker\Generator as Faker;
use App\Category;
use App\Brand;
use App\User;
use App\Product;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Category::class, function(Faker $faker) {
    $fakeName = $faker->name;

    return [
        'name' => $fakeName,
        'slug' => str_slug($fakeName),
        'parent_id' => null,
        'status' => true
    ];
});

$factory->define(Brand::class, function(Faker $faker) {
    $fakeName = $faker->name;

    return [
        'name' => $fakeName,
        'slug' => str_slug($fakeName),
        'status' => true
    ];
});

$factory->define(User::class, function(Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'is_admin' => false,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Product::class, function(Faker $faker) {
    $fakeName = $faker->name;
    $categoryId = factory(Category::class, 1)->create()->first()->id;
    $brandId = factory(Brand::class, 1)->create()->first()->id;
    factory(User::class, 5)->create();
    User::find(1)->update(['email' => 'duwaljyoti16@gmail.com']);

   return [
      'name' => $fakeName,
      'slug' =>  str_slug($fakeName),
      'description' => $faker->text,
      'category_id' => $categoryId,
      'brand_id' => $brandId
   ];
});