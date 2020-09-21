<?php

namespace Tests\Unit;

use Vegacms\Cms\Models\Menu;
use Vegacms\Cms\Models\MenuItem;
use Tests\VegaCmsTestCase as TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function menuItemHasAMenu()
    {
        $menuItem = MenuItem::factory()->create();

        $this->assertInstanceOf(Menu::class, $menuItem->menu);
    }

    /** @test */
    public function menuItemMayHasParentMenuItems()
    {
        $menuItem = MenuItem::factory()->create();
        $childMenuItem = MenuItem::factory()->create();

        $childMenuItem->parentMenuItem()->associate($menuItem);

        $this->assertEquals($childMenuItem->parentMenuItem->id, $menuItem->id);
    }

    /** @test */
    public function menuItemMayHasManyChildMenuItems()
    {
        $menuItem = MenuItem::factory()->create();
        $childMenuItems = MenuItem::factory()->count(10)->create();

        $menuItem->childMenuItems()->saveMany($childMenuItems);
        $this->assertCount(10, $menuItem->childMenuItems);
    }
}
