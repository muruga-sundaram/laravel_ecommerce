<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; 
use App\Models\Category; 
use App\Models\Product;

class CategorySeeder extends Seeder
{
    public function run(){
        $c1 = Category::create(['name'=>'Mobiles']);
        $c2 = Category::create(['name'=>'Accessories']);
        Product::create(['name'=>'Demo Phone','category_id'=>$c1->id,'price'=>9999,'description'=>'Demo smartphone','image'=>'uploads/demo_phone.jpg']);
        Product::create(['name'=>'Demo Charger','category_id'=>$c2->id,'price'=>499,'description'=>'Fast charger','image'=>'uploads/demo_charger.jpg']);
    }
}
