<?php

namespace Tests\Unit;

use Vegacms\Cms\Models\Page;
use Vegacms\Cms\Models\Container;
use Illuminate\Support\Facades\DB;
use Tests\VegaCmsTestCase as TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_page_may_has_many_containers()
    {
        $page = Page::factory()->create();

        $containersIds = Container::factory()->count(10)->create()->pluck('id')->toArray();

        $page->containers()->attach($containersIds);

        $this->assertCount(10, $page->containers);
    }

    public function page_can_load_all_assigned_containers_with_theirs_nested_containers()
    {
        $page = Page::factory()->create();

        $containers = Container::factory()->count(3)->create();

        $childContainers = Container::factory()->count(10)->create();

        $nestedContainers = Container::factory()->count(5)->create();

        $page->containers()->attach($containers->pluck('id')->toArray());

        $container->childContainers()->attach($childContainers->pluck('id')->toArray());

        $childContainers->each(function ($container) use($nestedContainers) {
            $container->childContainers()->attach($nestedContainers->pluck('id')->toArray());
        });

        $container->loadAllChildContainers();

        $queriesCount = 0;
        DB::listen(function ($query) use (&$queriesCount) {
            $queriesCount++;
        });

        $this->assertCount(5, $page->containers);

        foreach($page->containers as $container) {
            foreach ($container->childContainers as $childContainer) {
                $this->assertCount(10, $childContainer->childContainers);
                foreach($childContainer->childContainers() as $childNestedcontainer) {
                    $this->assertCount(5, $childNestedcontainer->childContainers);
                }
            }
        }


        $this->assertEquals(0 , $queriesCount);
    }
}
