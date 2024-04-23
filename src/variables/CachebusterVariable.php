<?php

namespace cachebuster\cachebuster\variables;

use craft\base\Component;
use craft\elements\User;
use yii\db\Query;
use craft\helpers\FileHelper;
use cachebuster\cachebuster\Cachebuster;

class CachebusterVariable extends Component
{
    /**
     * @return array
     */
    public function getModificationTime()
    {
        $directoryPath = CRAFT_BASE_PATH . '/web/dist'; // only check compiled files

        // Check if the directory exists
        if (!is_dir($directoryPath)) {
            return time();
        }

        // Get all files in the directory
        $files = $this->getFilesInDirectory($directoryPath);

        $totalModificationTime = 0;

        // $exemptFiles = ["$directoryPath/fslightbox.js", "$directoryPath/glide.js"];

        foreach ($files as $file) {
            // Skip exempt files
            // if (in_array($file, $exemptFiles)) {
                // continue;
            // }
            $filePath = $file;

            $modificationTime = filemtime($filePath);

            // Add the modification time to the total
            $totalModificationTime += $modificationTime;
            
        }

        return $totalModificationTime == 0 ? time() : $totalModificationTime;

        return null;
    }

    private function getFilesInDirectory($directoryPath)
    {
        return FileHelper::findFiles($directoryPath, [
            'recursive' => true, // Set to false if you don't want to include files in subdirectories
        ]);
    }
}