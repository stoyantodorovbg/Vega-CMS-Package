<?php

namespace Vegacms\Cms\Services\Interfaces;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

interface FileCreateServiceInterface
{
    /**
     * Create a middleware for the group
     *
     * @param string $folderPath
     * @param string $fileName
     * @param string $fileExtension
     * @param string $stubPath
     * @param bool $capitalize
     * @return bool|array
     */
    public function createFile(string $folderPath, string $fileName, string $fileExtension, string $stubPath, $capitalize = true);

    /**
     * Determine if the file already exists.
     *
     * @param string $folderPath
     * @param string $fileName
     * @param string $fileExtension
     * @return bool
     */
    public function fileExists(string $folderPath, string $fileName, string $fileExtension): bool;
}
