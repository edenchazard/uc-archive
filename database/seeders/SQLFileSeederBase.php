<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

abstract class SQLFileSeederBase extends Seeder
{
    protected string $file;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!$this->file)
            throw new Exception("no sql file specified.");

        $sql = '/var/www/html/database/seeders/' . $this->file;

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
