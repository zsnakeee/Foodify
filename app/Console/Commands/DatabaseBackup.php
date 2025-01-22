<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:database-backup {--clear} {--show}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('clear')) {
            $this->clear();

            return;
        }

        if ($this->option('show')) {
            $this->show();

            return;
        }

        $driver = config('database.default');
        match ($driver) {
            'sqlite' => $this->dump_sqlite(),
            'mysql' => $this->dump_mysql(),
            default => $this->error('Unsupported database driver'),
        };
    }

    private function dump_sqlite(): void
    {
        $database = config('database.connections.sqlite.database');
        $backup = Storage::disk('local')->path('backup/sqlite-dump-'.date('Y-m-d-H-i-s').'.sqlite');

        if (! file_exists($database)) {
            $this->error('Database file not found: '.$database);

            return;
        }

        if (! file_exists(dirname($backup))) {
            mkdir(dirname($backup), 0755, true);
        }

        file_put_contents($backup, file_get_contents($database));

        $this->info("Local backup created: $backup");
        $this->info('Backup size: '.$this->getFileSizeMB($backup).' MB');
        $this->upload($backup);
    }

    private function dump_mysql(): void
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $backup = storage_path('app/backup/'.$database.'-'.date('Y-m-d-H-i-s').'.sql');
        exec("mysqldump -u $username -p$password $database > $backup");
        $this->info('Local backup created: '.$backup);
        $this->info('Backup size: '.$this->getFileSizeMB($backup).' MB');
        $this->upload($backup);
    }

    private function upload(string $backup, string $disk = 'google', string $path = 'backup'): void
    {
        $this->info('Uploading backup...');
        Storage::disk($disk)->put($path.'/'.basename($backup), file_get_contents($backup));
        $this->info("$disk backup uploaded: $path/".basename($backup));
    }

    private function clear(): void
    {
        if ($this->confirm('Are you sure you want to clear all backups?')) {
            $this->info('Clearing local backups...');
            $this->clearLocal();
        }
    }

    private function show(): void
    {
        $backups = Storage::disk('local')->files('backup');
        $this->info('Local backups: '.count($backups));
        foreach ($backups as $backup) {
            $this->info($backup.' ('.$this->getFileSizeMB(Storage::disk('local')->path($backup)).' MB)');
        }
    }

    private function clearLocal(): void
    {
        $backups = Storage::disk('local')->files('backup');
        Storage::disk('local')->delete($backups);
        $this->info('Cleared '.count($backups).' local backups');
    }

    private function getFileSizeMB(string $file): float
    {
        return round(filesize($file) / 1024 / 1024, 2);
    }
}
