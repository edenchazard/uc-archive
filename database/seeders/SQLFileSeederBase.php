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

        if (DB::connection()->getDriverName() === 'sqlite') {
            $sql = preg_replace('/^\/\*!.*?\*\/;?\s*$/m', '', $sql) ?? $sql;
            $sql = str_replace('INSERT IGNORE INTO', 'INSERT OR IGNORE INTO', $sql);
            $sql = str_replace("\\'", "''", $sql);

            DB::statement('PRAGMA foreign_keys = OFF');
        }

        try {
            $status = DB::transaction(fn () => DB::unprepared($sql));
        } finally {
            if (DB::connection()->getDriverName() === 'sqlite') {
                DB::statement('PRAGMA foreign_keys = ON');
            }
        }

        Log::info($status ? '[success]' : '[failure]' . " importing sql data from {$path}");
    }
}
