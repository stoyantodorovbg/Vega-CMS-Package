<?php

namespace Tests\Unit;

use Vegacms\Cms\Models\Page;
use Vegacms\Cms\Models\Container;
use Illuminate\Support\Facades\DB;
use Tests\VegaCmsTestCase as TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContainerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_container_may_has_many_pages()
    {
        $container = Container::factory()->create();

        $pagesIds = Page::factory()->count(10)->create()->pluck('id')->toArray();

        $container->pages()->attach($pagesIds);

        $this->assertCount(10, $container->pages);
    }

    /** @test */
    public function the_container_may_has_many_parent_containers()
    {
        $container = Container::factory()->create();

        $parentContainersIds = Container::factory()->count(10)->create()->pluck('id')->toArray();

        $container->parentContainers()->attach($parentContainersIds);

        $this->assertCount(10, $container->parentContainers);
    }

    /** @test */
    public function the_container_may_has_many_child_containers()
    {
        $container = Container::factory()->create();

        $childContainersIds = Container::factory()->count(10)->create()->pluck('id')->toArray();

        $container->childContainers()->attach($childContainersIds);

        $this->assertCount(10, $container->childContainers);
    }

    /** @test */
    public function the_container_can_load_all_nested_child_containers()
    {
        $container = Container::factory()->create();

        $childContainers = Container::factory()->count(10)->create();

        $nestedContainers = Container::factory()->count(5)->create();

        $container->childContainers()->attach($childContainers->pluck('id')->toArray());

        $childContainers->each(function ($container) use($nestedContainers) {
            $container->childContainers()->attach($nestedContainers->pluck('id')->toArray());
        });

        $container->loadAllChildContainers();

        $queriesCount = 0;
        DB::listen(function ($query) use (&$queriesCount) {
            $queriesCount++;
        });

        $this->assertCount(10, $container->childContainers);

        foreach ($container->childContainers as $childContainer) {
            $this->assertCount(5, $childContainer->childContainers);
        }

        $this->assertEquals(0 , $queriesCount);
    }
}
