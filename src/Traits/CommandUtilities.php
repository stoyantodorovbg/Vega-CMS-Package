<?php

namespace Vegacms\Cms\Traits;

trait CommandUtilities
{
    /**
     * Get process the command arguments
     *
     * @return array
     */
    protected function processArguments(): array
    {
        $data = $this->arguments();

        if($key = array_search('null', $data)) {
            $data[$key] = '';
        }
        unset($data['command']);

        return $data;
    }

    /**
     * Generate the output from te console command
     *
     * @param $validationData
     * @param string $successMessage
     */
    protected function output($validationData, string $successMessage): void
    {
        if ($validationData === true) {
            $this->line($successMessage);
        } else {
            $this->line('Validation failed:');

            foreach ($validationData as $message) {
                $this->line($message);
            }
        }
    }
}
