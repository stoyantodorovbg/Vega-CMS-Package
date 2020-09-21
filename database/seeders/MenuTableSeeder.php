<?php

namespace Vegacms\Cms\Database\Seeders;

use Vegacms\Cms\Models\Menu;
use Vegacms\Cms\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \JsonException
     */
    public function run()
    {
        // Sidebar navigation - admin panel ID 1
        $menu = Menu::factory()->create([
            'title' => json_encode([
                'text' => 'Side Admin Menu',
                'status' => 0,
                'classes' => 'nav-title',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'description' => json_encode([
                'text' => 'Right side navigation for the administration.',
                'status' => 0,
                'classes' => 'admin-side-nav d-inline-flex p-3 pl-4 col-2',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'status' => 1,
            'classes' => 'admin-side-nav',
            'styles' => json_encode([], JSON_THROW_ON_ERROR),
        ]);

        // Sidebar navigation - admin panel - menu items
        MenuItem::factory()->create([
            'menu_id' => $menu->id,
            'parent_id' => null,
            'status' => 1,
            'url' => 'dashboard',
            'title' => json_encode([
                'text' => 'Dashboard',
                'status' => 1,
                'classes' => 'icon i-dashboard nav-item-text--light',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'description' => json_encode([
                'text' => '',
                'status' => 0,
                'classes' => '',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'prefix' => 'admin',
            'classes' => 'nav-item',
            'styles' => json_encode([], JSON_THROW_ON_ERROR),
        ]);

        MenuItem::factory()->create([
            'menu_id' => $menu->id,
            'parent_id' => null,
            'status' => 1,
            'url' => 'users',
            'title' => json_encode([
                'text' => 'Users',
                'status' => 1,
                'classes' => 'icon i-users nav-item-text--light',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'description' => json_encode([
                'text' => '',
                'status' => 0,
                'classes' => '',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'prefix' => 'admin',
            'classes' => 'nav-item',
            'styles' => json_encode([]),
        ]);

        MenuItem::factory()->create([
            'menu_id' => $menu->id,
            'parent_id' => null,
            'status' => 1,
            'url' => 'groups',
            'title' => json_encode([
                'text' => 'User groups',
                'status' => 1,
                'classes' => 'icon i-user-groups nav-item-text--light',
                'styles',
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'description' => json_encode([
                'text' => '',
                'status' => 0,
                'classes' => '',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'prefix' => 'admin',
            'classes' => 'nav-item',
            'styles' => json_encode([]),
        ]);

        MenuItem::factory()->create([
            'menu_id' => $menu->id,
            'parent_id' => null,
            'status' => 1,
            'url' => 'phrases',
            'title' => json_encode([
                'text' => 'Phrases',
                'status' => 1,
                'classes' => 'icon i-phrases nav-item-text--light',
                'styles',
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'description' => json_encode([
                'text' => '',
                'status' => 0,
                'classes' => '',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'prefix' => 'admin',
            'classes' => 'nav-item',
            'styles' => json_encode([]),
        ]);

        MenuItem::factory()->create([
            'menu_id' => $menu->id,
            'parent_id' => null,
            'status' => 1,
            'url' => 'locales',
            'title' => json_encode([
                'text' => 'Locales',
                'status' => 1,
                'classes' => 'icon i-locales nav-item-text--light',
                'styles',
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'description' => json_encode([
                'text' => '',
                'status' => 0,
                'classes' => '',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'prefix' => 'admin',
            'classes' => 'nav-item',
            'styles' => json_encode([]),
        ]);

        MenuItem::factory()->create([
            'menu_id' => $menu->id,
            'parent_id' => null,
            'status' => 1,
            'url' => 'routes',
            'title' => json_encode([
                'text' => 'Routes',
                'status' => 1,
                'classes' => 'icon i-routes nav-item-text--light',
                'styles',
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'description' => json_encode([
                'text' => '',
                'status' => 0,
                'classes' => '',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'prefix' => 'admin',
            'classes' => 'nav-item',
            'styles' => json_encode([]),
        ]);

        MenuItem::factory()->create([
            'menu_id' => $menu->id,
            'parent_id' => null,
            'status' => 1,
            'url' => 'menus',
            'title' => json_encode([
                'text' => 'Menus',
                'status' => 1,
                'classes' => 'icon i-menu nav-item-text--light',
                'styles',
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'description' => json_encode([
                'text' => '',
                'status' => 0,
                'classes' => '',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'prefix' => 'admin',
            'classes' => 'nav-item',
            'styles' => json_encode([]),
        ]);

        MenuItem::factory()->create([
            'menu_id' => $menu->id,
            'parent_id' => null,
            'status' => 1,
            'url' => 'pages',
            'title' => json_encode([
                'text' => 'Pages',
                'status' => 1,
                'classes' => 'icon i-page nav-item-text--light',
                'styles',
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'description' => json_encode([
                'text' => '',
                'status' => 0,
                'classes' => '',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'prefix' => 'admin',
            'classes' => 'nav-item',
            'styles' => json_encode([], JSON_THROW_ON_ERROR),
        ]);

        MenuItem::factory()->create([
            'menu_id' => $menu->id,
            'parent_id' => null,
            'status' => 1,
            'url' => 'containers',
            'title' => json_encode([
                'text' => 'Containers',
                'status' => 1,
                'classes' => 'icon i-page nav-item-text--light',
                'styles',
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'description' => json_encode([
                'text' => '',
                'status' => 0,
                'classes' => '',
                'styles' => [],
                'structure' => [
                    'text' => [
                        'type' => 'text'
                    ],
                    'status' => [
                        'type' => 'text'
                    ],
                    'classes' => [
                        'type' => 'text'
                    ],
                    'styles' => [
                        'type' => 'json',
                        'nested' => [],
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'prefix' => 'admin',
            'classes' => 'nav-item',
            'styles' => json_encode([], JSON_THROW_ON_ERROR),
        ]);
    }
}
