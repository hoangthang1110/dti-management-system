<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        // \App\Models\User::factory(10)->create(); // Nếu bạn muốn tạo thêm người dùng ngẫu nhiên
        // Gọi các seeder khác của bạn
        $this->call([
            RoleAndPermissionSeeder::class, // <-- ĐẢM BẢO DÒNG NÀY CÓ Ở ĐÂY
            // Thêm các seeder khác nếu có
        ]);
    }
}
