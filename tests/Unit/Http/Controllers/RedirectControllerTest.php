<?php
namespace Knash94\Seo\Tests\Unit\Http\Controllers;

use Knash94\Seo\Store\Eloquent\Models\HttpRedirect;
use Knash94\Seo\Tests\Unit\TestCase;

class RedirectControllerTest extends TestCase
{
    /** @test */
    public function it_returns_404_if_id_does_not_exist()
    {
        $request = $this->get(route('seo-tools.redirect.edit', 1));

        $request->assertResponseStatus(404);
    }

    /** @test */
    public function it_shows_edit_page()
    {
        $redirect = factory(HttpRedirect::class)->create();

        $request = $this->get(route('seo-tools.redirect.edit', $redirect->id));

        $request->assertResponseStatus(200);
        $request->assertViewHas('template');
        $request->seeText('Manage redirect');
    }

    /** @test */
    public function it_updates_redirect()
    {
        $redirect = factory(HttpRedirect::class)->create();

        $request = $this->post(
            route('seo-tools.redirect.update', $redirect->id),
            [
                'redirect_url' => 'https://www.google.com',
                'path' => '/test',
                'status_code' => 302
            ]
        );
        $redirect = $redirect->fresh();

        $request->assertResponseStatus(302);
        $request->assertSessionHas('seo-tools.message');
        $this->assertEquals($redirect->redirect_url, 'https://www.google.com');
    }

    /** @test */
    public function it_creates_a_redirect()
    {
        $initialCount = HttpRedirect::count();

        $request = $this->post(
            route('seo-tools.redirect.store'),
            [
                'redirect_url' => 'https://www.google.com',
                'path' => '/test',
                'status_code' => 302
            ]
        );

        $request->assertResponseStatus(302);
        $request->assertSessionHas('seo-tools.message');
        $this->assertNotEquals($initialCount, HttpRedirect::count());
    }

    /** @test */
    public function it_shows_delete_screen()
    {
        $redirect = factory(HttpRedirect::class)->create();

        $request = $this->get(route('seo-tools.redirect.remove', $redirect->id));

        $request->assertResponseStatus(200);
        $request->assertViewHas('template');
        $request->seeText('Delete redirect');
    }

    /** @test */
    public function it_destroys_a_redirect()
    {
        $redirect = factory(HttpRedirect::class)->create();

        $request = $this->get(route('seo-tools.redirect.destroy', $redirect->id));

        $request->assertResponseStatus(302);
        $request->assertSessionHas('seo-tools.message');
        $this->assertEmpty(HttpRedirect::count());
    }
}