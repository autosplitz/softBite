<?php

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $categories = factory(Category::class, 5)->create();
        // $categories->each(function ($category) {
        //     factory(\App\Models\Menu::class, 3)->create([
        //         'category_id' => $category->id,
        //     ]);
        // });

        $dummyCategory = collect([
            'Soups', 'Chicken Main Course', 'Non-veg Rise', 'Non-veg Noodles'
        ]);

        $dummyCategory->each(function ($value) {
            factory(Category::class)->create(['name' => $value]);
        });

        $this->addSoups();
        $this->addChickenMainCourse();
        $this->addNonVegRice();
        $this->addNonVegNoodle();
    }

    private function addSoups()
    {
        factory(Menu::class)->create([
            'name' => 'Chicken Barmee Soup',
            'price' => 170,
            'category_id' => 1,
            'description' => 'This is a soup made from chicken in Barmee'
        ]);

        factory(Menu::class)->create([
            'name' => 'Chicken Beijing Soup',
            'price' => 160,
            'category_id' => 1,
            'description' => 'This is a soup made from chicken in Beijing'
        ]);

        factory(Menu::class)->create([
            'name' => 'Chicken Wanton Soup',
            'price' => 160,
            'category_id' => 1,
            'description' => 'This is a soup made from chicken in Wanton'
        ]);
    }

    private function addChickenMainCourse()
    {
        factory(Menu::class)->create([
            'name' => 'Grilled Chicken Panini',
            'price' => 290,
            'category_id' => 2,
            'description' => 'This is a grilled chicken in Panini'
        ]);

        factory(Menu::class)->create([
            'name' => 'Sapo Chicken',
            'price' => 310,
            'category_id' => 2,
            'description' => 'This is a chicken in Sapo'
        ]);

        factory(Menu::class)->create([
            'name' => 'Chicken Black Bean',
            'price' => 270,
            'category_id' => 2,
            'description' => 'This is a chicken from Bean'
        ]);
    }

    private function addNonVegRice()
    {
        factory(Menu::class)->create([
            'name' => 'Chicken Fried Rice',
            'price' => 220,
            'category_id' => 3,
            'description' => 'This is a chicken fried rice'
        ]);

        factory(Menu::class)->create([
            'name' => 'Hainanese Chicken Rice',
            'price' => 250,
            'category_id' => 3,
            'description' => 'This is a Hainanese Chicken Rice'
        ]);

        factory(Menu::class)->create([
            'name' => 'Chicken Chettinad',
            'price' => 280,
            'category_id' => 3,
            'description' => 'This is a Chettinad chicken'
        ]);
    }

    private function addNonVegNoodle()
    {
        factory(Menu::class)->create([
            'name' => 'Chongqing Noodles',
            'price' => 360,
            'category_id' => 4,
            'description' => 'This is a chicken Noodles'
        ]);

        factory(Menu::class)->create([
            'name' => 'Chow Mein Noodles',
            'price' => 280,
            'category_id' => 4,
            'description' => 'This is a Chicken Noodles'
        ]);

        factory(Menu::class)->create([
            'name' => 'Cart Noodles',
            'price' => 280,
            'category_id' => 4,
            'description' => 'This is a Noodles chicken'
        ]);
    }
}
