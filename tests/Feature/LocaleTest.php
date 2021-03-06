<?php

namespace Tests\Feature;

use Vegacms\Cms\Models\Locale;
use Tests\VegaCmsTestCase as TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocaleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_selected_locale_can_be_changed_via_http_request(): void
    {
        app()->setLocale('en');

        Locale::factory()->create([
            'code' => 'bg',
        ]);

        $this->post(route('locales.set-locale'), ['code' => 'bg'])
        ->assertStatus(200);

        $this->assertEquals('bg', app()->getLocale());
    }

    /** @test */
    public function the_selected_locale_is_set_in_the_session(): void
    {
        Locale::factory()->create([
            'code' => 'bg',
        ]);

        $this->post(route('locales.set-locale'), ['code' => 'bg'])
            ->assertStatus(200)
            ->assertSessionHas('locale', 'bg');
    }

    /** @test */
    public function the_selected_locale_have_to_exists_in_database(): void
    {
        $response = $this->post(route('locales.set-locale'), ['code' => 'bg'])
            ->assertStatus(302);

        $this->assertNotSame(strpos($response->getContent(), 'The selected code is invalid.'), false);
    }

    /** @test */
    public function the_selected_locale_have_to_consists_of_exactly_two_characters(): void
    {
        $response = $this->post(route('locales.set-locale'), ['code' => 'bga'])
            ->assertStatus(302);

        $this->assertNotFalse(strpos($response->getContent(), 'The code may not be greater than 2 characters.'));

        $response = $this->post(route('locales.set-locale'), ['code' => 'b'])
            ->assertStatus(302);

        $this->assertNotFalse(strpos($response->getContent(), 'The selected code is invalid.'));

        $response = $this->post(route('locales.set-locale'), ['code' => ''])
            ->assertStatus(302);

        $this->assertNotFalse(strpos($response->getContent(), 'The code must be a string.'));
    }

    /** @test */
    public function the_app_locale_is_synchronized_with_session_locale_on_every_request(): void
    {
        $this->withoutExceptionHandling();

        session(['locale' => 'en']);
        app()->setLocale('bg');

        $this->get(route('test.route'));

        $this->assertEquals('en', app()->getLocale());
    }
}
