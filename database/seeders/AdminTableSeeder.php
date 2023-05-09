<?php
namespace Database\Seeders;

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        Admin::firstOrCreate(['email' => 'admin@'.config('app.domain')],[
            'name' => 'Admin',
            'email' => 'admin@'.config('app.domain'),
            'password' => Hash::make('secret123')
        ]);
    }
}
