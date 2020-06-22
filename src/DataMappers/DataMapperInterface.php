<?php

namespace Vegacms\Cms\DataMappers;

interface DataMapperInterface
{
    /**
     * Map data
     *
     * @param array $data
     * @return array
     */
    public function mapData(array $data): array;
}
