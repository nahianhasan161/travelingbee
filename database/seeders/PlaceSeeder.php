<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Place;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        // ... Some Truncate Query
        Place::truncate();
        Category::truncate();

        Schema::enableForeignKeyConstraints();
        Place::create([
            'name' => "Fantasy Kingdom",
            'description' => ' is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, ',
            'features' => ' is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, ',
            'price' => 100,
            'category_id' => 1,
            'user_id' => 5,
            'division' => 'Dhaka',
            'district' => 'Dhaka',
            'area' => 'Dhaka'
        ]);
        Category::create(['name' => 'All']);
    }
}
