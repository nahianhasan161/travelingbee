<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = ['Sea Beatch','swimming Pool','Park','Amusment Park','Forest','River Side','Natural Place'];
        foreach($cats as $cat){

            Category::create(['name'=>$cat]);
        }
    }
}
