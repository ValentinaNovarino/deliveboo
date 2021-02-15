<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Dish;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(Faker $faker)
   {
       for ($i=0; $i < 20 ; $i++) {
       $newDish = new Dish();
       $newDish->name = $faker->sentence(2);
       $newDish->price = $faker->randomFloat(2, 5, 100);
       $newDish->description = $faker->text(200);
       $newDish->visible = true;
       $newDish->cover = $faker->imageUrl(250, 250, 'foods', true);

       $slug = Str::slug($newDish->name, '-');

       $slugEditable = $slug;

       $currentSlug = Dish::where('slug', $slug)->first();

       $counter = 1;
       while($currentSlug) {
           $slug = $slugEditable . '-' . $counter;
           $counter++;
           $currentSlug = Dish::where('slug', $slug)->first();
       }

       $newDish->slug = $slug;

        $newDish->save();
        }
    }
}
