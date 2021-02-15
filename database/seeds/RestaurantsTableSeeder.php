<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(Faker $faker)
     {
         for ($i=0; $i < 20 ; $i++) {
         $newRestaurant = new Restaurant();
         $newRestaurant->name = $faker->sentence(2);
         $newRestaurant->city = $faker->word();
         $newRestaurant->address = $faker->sentence(3);

         $slug = Str::slug($newRestaurant->name, '-');

         $slugEditable = $slug;

         $currentSlug = Restaurant::where('slug', $slug)->first();

         $counter = 1;
         while($currentSlug) {
             $slug = $slugEditable . '-' . $counter;
             $counter++;
             $currentSlug = Restaurant::where('slug', $slug)->first();
         }

         $newRestaurant->slug = $slug;

         $newRestaurant->save();
         }
     }


}
