<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class SQLFileSeederBase extends Seeder
{
    protected string $file;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! $this->file) {
            throw new Exception('no sql file specified.');
        }

        $path = dirname(__DIR__) . "/seeders/{$this->file}";
        $sql = file_get_contents($path);

        $status = DB::unprepared($sql);

        Log::info($status ? '[success]' : '[failure]' . " importing sql data from {$path}");
    }
}
