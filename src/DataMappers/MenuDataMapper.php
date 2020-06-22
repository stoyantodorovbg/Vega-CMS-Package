<?php

namespace Vegacms\Cms\DataMappers;

class MenuDataMapper extends JsonDataMapper implements DataMapperInterface
{
    /**
     * Map data
     *
     * @param array $data
     * @return array
     */
    public function mapData(array $data): array
    {
        $emptyJsonField = json_encode([]);
        $mappedData = [
            'title' => $emptyJsonField,
            'description' => $emptyJsonField,
            'styles' => $emptyJsonField,
        ];
        $mappedData = $this->processJsonData($data, $mappedData);

        return $mappedData;
    }
}
