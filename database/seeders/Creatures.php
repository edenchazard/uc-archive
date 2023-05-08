<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class Creatures extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $sql = '/var/www/html/database/seeders/creatures.sql';
          
        $db = [
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'host' => env('DB_HOST'),
            'database' => env('DB_DATABASE')
        ];
  
        exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database {$db['database']} < $sql");
  
        Log::info('SQL Import Done');
    }
}
