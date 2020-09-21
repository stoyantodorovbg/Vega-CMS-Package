<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Vegacms\Cms\Models\Group;
use Tests\VegaCmsTestCase as TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_models_API_requires_admins_rights()
    {
        $this->json('GET', route('admin-models.index'), [
            'model' => '\\Vegacms\\Cms\\Models\\Group',
            'items_per_page' => 20,
        ])->assertStatus(401)->assertExactJson(['error' => 'Unauthenticated.']);

        $this->authenticate();
        Group::factory()->count(5)->create();

        $this->json('GET', route('admin-models.index'), [
            'model' => 'Group',
            'items_per_page' => 20,
        ])->assertStatus(401)->assertExactJson(['error' => 'Unauthenticated.']);
    }

    /** @test */
    public function all_items_from_a_model_can_be_fetched()
    {
        $this->withoutExceptionHandling();
        $this->authenticate(null, 'admins');

        Group::factory()->count(5)->create();

        $response = $this->json('GET', route('admin-models.index'), [
            'model' => '\\Vegacms\\Cms\\Models\\Group',
            'items_per_page' => 20,
        ])->assertStatus(200);

        $this->assertJson($response->content());
        $this->assertCount(8, $response->getOriginalContent()->items());
        $this->assertEquals('admins', $response->getOriginalContent()->items()[0]->title);
    }

    /** @test */
    public function the_model_items_could_be_searched_by_exact_matching()
    {
        $this->authenticate(null, 'admins');

        Group::factory()->count(5)->create([
            'status' => 0,
        ]);

        $response = $this->json('GET', route('admin-models.index'), [
            'model' => '\\Vegacms\\Cms\\Models\\Group',
            'filters' => json_encode([
                'status' => [
                    'types' => [
                        'exact' => [
                            'value' => 1,
                        ]
                    ]
                ],
            ], JSON_THROW_ON_ERROR),
            'items_per_page' => 20,
        ])->assertStatus(200);

        $this->assertCount(3, $response->getOriginalContent()->items());

        $response = $this->json('GET', route('admin-models.index'), [
            'model' => '\\Vegacms\\Cms\\Models\\Group',
            'filters' => json_encode([
                'status' => [
                    'types' => [
                        'exact' => [
                            'value' => 0,
                        ]
                    ]
                ]
            ], JSON_THROW_ON_ERROR),
            'items_per_page' => 20,
        ])->assertStatus(200);

        $this->assertCount(5, $response->getOriginalContent()->items());

        $response = $this->json('GET', route('admin-models.index'), [
            'model' => '\\Vegacms\\Cms\\Models\\Group',
            'filters' => json_encode([
                'title' => [
                    'types' => [
                        'exact' => [
                            'value' => 'admins',
                        ]
                    ]
                ]
            ], JSON_THROW_ON_ERROR),
            'items_per_page' => 20,
        ])->assertStatus(200);

        $this->assertCount(1, $response->getOriginalContent()->items());
        $this->assertEquals('admins', $response->getOriginalContent()->items()[0]->title);

        $response = $this->json('GET', route('admin-models.index'), [
            'model' => '\\Vegacms\\Cms\\Models\\Group',
            'filters' => json_encode([
                'title' => [
                    'types' => [
                        'exact' => [
                            'value' => 'admin',
                        ]
                    ]
                ]
            ], JSON_THROW_ON_ERROR),
            'items_per_page' => 20,
        ])->assertStatus(200);

        $this->assertCount(0, $response->getOriginalContent()->items());
    }

    /** @test */
    public function the_model_items_could_be_searched_by_partial_matching()
    {
        $this->authenticate(null, 'admins');

        Group::factory()->count(5)->create();

        $response = $this->json('GET', route('admin-models.index'), [
            'model' => '\\Vegacms\\Cms\\Models\\Group',
            'filters' => json_encode([
                'title' => [
                    'types' => [
                        'like' => [
                            'value' => 'adm',
                        ]
                    ]
                ]
            ], JSON_THROW_ON_ERROR),
            'items_per_page' => 20,
        ])->assertStatus(200);

        $this->assertCount(1, $response->getOriginalContent()->items());
        $this->assertEquals('admins', $response->getOriginalContent()->items()[0]->title);
    }

    /** @test */
    public function the_model_items_could_be_searched_by_greater_then_value()
    {
        $this->authenticate(null, 'admins');

        Group::factory()->count(5)->create([
            'created_at' => Carbon::now()->subWeek()
        ]);

        $response = $this->json('GET', route('admin-models.index'), [
            'model' => '\\Vegacms\\Cms\\Models\\Group',
            'filters' => json_encode([
                'created_at' => [
                    'types' => [
                        'greaterThen' => [
                            'value' => Carbon::now()->subDay(),
                        ]
                    ]
                ]
            ], JSON_THROW_ON_ERROR),
            'items_per_page' => 20,
        ])->assertStatus(200);

        $this->assertCount(3, $response->getOriginalContent());
    }

    /** @test */
    public function the_model_items_could_be_searched_by_less_then_value()
    {
        $this->withoutExceptionHandling();
        $this->authenticate(null, 'admins');

        Group::factory()->count(5)->create([
            'created_at' => Carbon::now()->subWeek()
        ]);

        $response = $this->json('GET', route('admin-models.index'), [
            'model' => '\\Vegacms\\Cms\\Models\\Group',
            'filters' => json_encode([
                'created_at' => [
                    'types' => [
                        'lessThen' => [
                            'value' => Carbon::now()->subDay(),
                        ]
                    ]
                ]
            ], JSON_THROW_ON_ERROR),
            'items_per_page' => 20,
        ])->assertStatus(200);

        $this->assertCount(5, $response->getOriginalContent()->items());
    }
}
