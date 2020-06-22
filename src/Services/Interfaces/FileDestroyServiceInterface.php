<?php

namespace Vegacms\Cms\Services\Interfaces;

interface FileDestroyServiceInterface
{
    /**
     * Destroy a file
     *
     * @param string $folderPath
     * @param string $fileName
     * @param string $fileExtension
     * @return bool
     */
    public function destroyFile(string $folderPath, string $fileName, string $fileExtension): bool;
}
