<?php

namespace App\Console\Commands;

use App\Services\BackupService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GoogleDriveUploadBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google-drive:upload-backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uploads last backup file to Google Drive folder.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lastFile = BackupService::getLastFile();

        Storage::disk('google')->put($lastFile->getFilename(), $lastFile->getContents());
    }
}
