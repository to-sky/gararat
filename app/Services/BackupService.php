<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class BackupService
{
    /**
     * Get files files from backup folder
     *
     * @return array|\Symfony\Component\Finder\SplFileInfo[]
     */
    public static function getBackupFiles()
    {
        $backupFolder = storage_path('app/') . config('backup.backup.name');

        $backupFiles = File::allFiles($backupFolder);

        return array_reverse($backupFiles);
    }
}