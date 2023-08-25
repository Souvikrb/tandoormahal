<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Submenu;
class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin Menu
            Submenu::create([
                'icon' => '<i class="nav-icon fas fa-shopping-cart"></i>',
                'label' => 'All Products',
                'link' => '/admin/products',
                'menu' => '4',
                'role' => '1',
                'order' => '1',
                'status' => '1'
            ]);
            Submenu::create([
                'icon' => '<i class="nav-icon fas fa-plus-circle"></i>',
                'label' => 'add Product',
                'link' => '/admin/products/add',
                'menu' => '4',
                'role' => '1',
                'order' => '2',
                'status' => '1'
            ]);

            
        //end
    }
}
