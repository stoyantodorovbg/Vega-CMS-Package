<?php

namespace Vegacms\Cms\Traits;

trait FileUtilities
{
    /**
     * Determine if the file already exists.
     *
     * @param string $folderPath
     * @param string $fileName
     * @param string $fileExtension
     * @param bool $capitalize
     * @return bool
     */
    public function fileExists(string $folderPath, string $fileName, string $fileExtension, $capitalize = true): bool
    {
        return $this->fileSystem->exists($this->getFilePath($folderPath, $fileName, $fileExtension, $capitalize));
    }

    /**
     * Get file path.
     *
     * @param string $folderPath
     * @param string $fileName
     * @param $fileExtension
     * @param bool $capitalise
     * @return string
     */
    protected function getFilePath(string $folderPath, string $fileName, $fileExtension, $capitalise = true): string
    {
        if($capitalise) {
            $fileName = ucfirst($fileName);
        }
        return base_path() . $folderPath . $fileName . $fileExtension;
    }
}
