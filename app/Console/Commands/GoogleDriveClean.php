<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GoogleDriveClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google-drive:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes all files from Google Drive folder.';

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
        $client = new \Google_Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

        $service = new \Google_Service_Drive($client);

        foreach (Storage::disk('google')->allFiles() as $file) {
            try {
                $service->files->delete($file);
            } catch (Exception $e) {
                Log::error("An error occurred: " . $e->getMessage());
            }
        }
    }
}
