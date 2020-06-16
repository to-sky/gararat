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
        if (! $backupFolder = config('backup.backup.name')) {
            return null;
        }

        $backupPath = storage_path('app/') . $backupFolder;

        if(! File::exists($backupPath)) {
            return null;
        }

        $backupFiles = File::allFiles($backupPath);

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