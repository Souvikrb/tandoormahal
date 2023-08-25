<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //User menu
            Menu::create([
                'icon' => '<i class="nav-icon fas fa-box"></i>',
                'label' => 'Your Orders',
                'link' => '/user/order',
                'role' => '2',
                'orders' => '1',
                'status' => '1'
            ]);

            Menu::create([
                'icon' => '<i class="nav-icon fa fa-user"></i>',
                'label' => 'Your Profile',
                'link' => '/user/profile',
                'role' => '2',
                'orders' => '2',
                'status' => '1'
            ]);

            Menu::create([
                'icon' => '<i class="nav-icon fas fa-arrow-right"></i>',
                'label' => 'Logout',
                'link' => '/logout',
                'role' => '2',
                'orders' => '3',
                'status' => '1'
            ]);
        //End

        //Admin Menu
            Menu::create([
                'icon' => '<i class="nav-icon fas fa-store"></i>',
                'label' => 'Products',
                'link' => '',
                'role' => '1',
                'orders' => '1',
                'status' => '1'
            ]);

            Menu::create([
                'icon' => '<i class="nav-icon fas fa-box"></i>',
                'label' => 'Orders',
                'link' => '/admin/order',
                'role' => '1',
                'orders' => '2',
                'status' => '1'
            ]);
        //
    }
}
