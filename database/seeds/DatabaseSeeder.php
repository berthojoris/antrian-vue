<?php

use App\User;
use App\Order;
use App\OrderDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@antrian.com',
            'password' => '$2y$10$EnDqISvvP5KR/tPJV1CDoODHVP1F6fZpijI/RXrg6hWr31stHMhJu'
        ]);
        
        // Order::create([
        //     'table_id' => '001',
        //     'table_name' => 'BERTHO',
        //     'user_order' => 'ADMIN'
        // ]);

        // $data = array(
        //     ['table_id' => '001', 'menu_name' => 'NASI', 'created_at' => date('Y-m-d H:i:s')],
        //     ['table_id' => '001', 'menu_name' => 'CUMI TEPUNG', 'created_at' => date('Y-m-d H:i:s')],
        //     ['table_id' => '001', 'menu_name' => 'CAH KANGKUNG', 'created_at' => date('Y-m-d H:i:s')],
        //     ['table_id' => '001', 'menu_name' => 'EH TEH MANIS', 'created_at' => date('Y-m-d H:i:s')]
        // );
        
        // OrderDetail::insert($data);
    }
}
