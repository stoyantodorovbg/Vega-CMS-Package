<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Group;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_group_can_be_generated_through_the_console(): void
    {
        $this->artisan('generate:group test --description=description')
            ->expectsOutput('The group is generated successfully.');

        $this->assertDatabaseHas('groups', [
            'title' => 'test',
            'description' => 'description',
        ]);

        $this->artisan('destroy:group test');
    }

    /** @test */
    public function the_group_generate_command_requires_a_title_parameter(): void
    {
        $this->expectException('Symfony\Component\Console\Exception\RuntimeException');
        $this->artisan('generate:group');

        $this->artisan('generate:group "" --description=')
            ->expectsOutput('Validation failed:')
            ->expectsOutput('The title field is required.');

        $this->assertDatabaseMissing('groups', [
            'title' => '',
            'description' => 'description',
        ]);
    }

    /** @test */
    public function the_group_generate_command_requires_a_non_existing_group_title(): void
    {
        $this->artisan('generate:group test');

        $this->assertDatabaseHas('groups', [
            'title' => 'test',
        ]);

        $this->artisan('generate:group test')
            ->expectsOutput('Validation failed:')
            ->expectsOutput('The title has already been taken.');

        $this->assertCount(1, Group::where('title', 'test')->get());

        $this->artisan('destroy:group test');
    }

    /** @test */
    public function the_group_generate_command_creates_a_middleware(): void
    {
        $this->artisan('generate:group test');
        $this->assertFileExists(base_path() . '/app/Http/Middleware/Test.php');

        $this->artisan('destroy:group test');
    }
        /** @test */
    public function the_group_can_be_destroyed_through_the_command_line(): void
    {
        $this->artisan('generate:group test');

        $this->assertDatabaseHas('groups', [
            'title' => 'test',
        ]);

        $this->assertFileExists(base_path() . '/app/Http/Middleware/Test.php');

        $this->artisan('destroy:group test');

        $this->assertDatabaseMissing('groups', [
            'title' => 'test',
        ]);

        $this->assertFileNotExists(base_path() . '/app/Http/Middleware/Test.php');
    }

    /** @test */
    public function the_group_destroy_command_requires_an_existing_in_database_group_title(): void
    {
        $this->artisan('generate:group testTest');

        $this->assertDatabaseHas('groups', [
            'title' => 'testTest',
        ]);

        $route = Group::where('title', 'testTest')->first();
        $route->delete();

        $this->artisan('destroy:group test_test')
            ->expectsOutput('Validation failed:')
            ->expectsOutput('The selected title is invalid.');

        $this->assertFileExists(base_path() . '/app/Http/Middleware/TestTest.php');

        factory(Group::class)->create([
            'title' => 'testTest',
        ]);

        $this->artisan('destroy:group testTest');
    }

    /** @test */
    public function the_group_destroy_command_requires_a_valid_group_title(): void
    {
        $this->artisan('destroy:group test1')
            ->expectsOutput('Validation failed:')
            ->expectsOutput('The title format is invalid.');
    }
}
