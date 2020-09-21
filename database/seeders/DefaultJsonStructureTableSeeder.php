<?php

namespace Vegacms\Cms\Database\Seeders;

use Vegacms\Cms\Models\Page;
use Vegacms\Cms\Models\Menu;
use Vegacms\Cms\Models\MenuItem;
use Vegacms\Cms\Models\Container;
use Illuminate\Database\Seeder;
use Vegacms\Cms\Models\DefaultJsonStructure;

class DefaultJsonStructureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \JsonException
     */
    public function run()
    {
        // Menu
        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                Menu::class,
                'title',
                $this->getDefaultMenuUnitStructure()
            ));

        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                Menu::class,
                'description',
                $this->getDefaultMenuUnitStructure()
            ));

        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                Menu::class,
                'styles',
                json_encode([], JSON_THROW_ON_ERROR)
            ));

        // MenuItem
        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                MenuItem::class,
                'title',
                $this->getDefaultMenuUnitStructure()
            ));

        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                MenuItem::class,
                'description',
                $this->getDefaultMenuUnitStructure()
            ));

        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                MenuItem::class,
                'styles',
                json_encode([], JSON_THROW_ON_ERROR)
            ));

        // Page
        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                Page::class,
                'styles',
                json_encode([], JSON_THROW_ON_ERROR)
            ));

        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                Page::class,
                'meta_tags',
                json_encode([], JSON_THROW_ON_ERROR)
            ));

        // Container
        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                Container::class,
                'title',
                json_encode([])
            ));

        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                Container::class,
                'summary',
                json_encode([], JSON_THROW_ON_ERROR)
            ));

        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                Container::class,
                'body',
                json_encode([], JSON_THROW_ON_ERROR)
            ));

        DefaultJsonStructure::factory()
            ->create($this->getDefaultStructure(
                Container::class,
                'styles',
                json_encode([], JSON_THROW_ON_ERROR)
            ));
    }

    /**
     * Get default structure
     *
     * @param string $model
     * @param string $field
     * @param string $structure
     * @return array
     */
    protected function getDefaultStructure(string $model, string $field, string $structure): array
    {
        return [
            'model' => $model,
            'field' => $field,
            'structure' => $structure
        ];
    }

    /**
     * Get default structure for a menu unit
     *
     * @return string
     * @throws \JsonException
     */
    protected function getDefaultMenuUnitStructure(): string
    {
        return json_encode([
            'structure' => [
                'text' => '',
                'status' => 0,
                'classes' => '',
                'styles' => [

                ],
                'structure' => [
                    'text' => [
                        'type' => 'text',
                    ],
                    'status' => [
                        'type' => 'text',
                    ],
                    'classes' => [
                        'type' => 'text',
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => []
                    ]
                ]
            ]
        ], JSON_THROW_ON_ERROR);
    }
}
