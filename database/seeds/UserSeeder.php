<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new User();
      $user->userName          = 'ADMINISTRADOR';
      $user->name           = 'SIN INFORMACIÓN';

      $user->email            = 'admin@gmail.com';
      $user->password         = bcrypt('temporal2020');
    
      $user->save();
    }
}
