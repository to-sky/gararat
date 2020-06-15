<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class BackupService
{
    /**
     * Get files from backup folder
     *
     * @return array|\Symfony\Component\Finder\SplFileInfo[]
     */
    public static function getFiles()
    {
        $backupFolder = storage_path('app/') . config('backup.backup.name');

        if(! File::exists($backupFolder)) {
            mkdir($backupFolder, 0755, true);
        }

        $backupFiles = File::allFiles($backupFolder);

        return array_reverse($backupFiles);
    }

    /**
     * Get latest created file
     *
     * @return mixed|\Symfony\Component\Finder\SplFileInfo
     */
    public static function getLastFile()
    {
        return self::getFiles()[0];
    }
}