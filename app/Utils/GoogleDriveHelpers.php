<?php 

namespace App\Utils;

use Illuminate\Support\Facades\Storage;

class GoogleDriveHelpers {

    /**
     *
     * @param string $dirName
     * @return array metadata of created/current directory
     */
    public static function createDirIfNotExists(string $dirName): array
    {
        $matches = collect(Storage::disk('google')->directories())
                ->map(function ($dirPath) {
                    return Storage::disk('google')->getMetaData($dirPath);
                })
                ->filter(function ($dir) use ($dirName) {
                    return strToLower($dir['name']) === strToLower($dirName);
                })
                ->toArray();

        if (count($matches) > 0)
            return collect($matches)->first();

        Storage::disk('google')->createDir($dirName);
        return Storage::disk('google')->getMetaData($dirName);
    }

}
