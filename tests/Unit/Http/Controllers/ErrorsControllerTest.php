<?php
namespace Knash94\Seo\Tests\Unit\Http\Controllers;

use Knash94\Seo\Store\Eloquent\Models\HttpError;
use Knash94\Seo\Tests\Unit\TestCase;

class ErrorsControllerTest extends TestCase
{
    /** @test */
    public function it_returns_404_if_id_does_not_exist()
    {
        $request = $this->get(route('seo-tools.error.view', 1));

        $request->assertResponseStatus(404);
    }

    /** @test */
    public function it_returns_error_view_when_pass_id()
    {
        $error = factory(HttpError::class)->create();

        $request = $this->get(route('seo-tools.error.view', $error->id));

        $request->assertResponseStatus(200);
        $request->assertViewHas('template');
        $request->assertViewHas('requests');
        $request->assertViewHas('httpError');
        $request->seeText('User Agent');
    }

    /** @test */
    public function it_shows_edit_page()
    {
        $error = factory(HttpError::class)->create();

        $request = $this->get(route('seo-tools.error.edit', $error->id));

        $request->assertResponseStatus(200);
        $request->assertViewHas('template');
        $request->seeText('Managing');
    }

    /** @test */
    public function it_updates_errors()
    {
        $error = factory(HttpError::class)->create();

        $request = $this->post(
            route('seo-tools.error.update', $error->id),
            [
                'redirect_url' => 'https://www.google.com',
                'status_code' => 302
            ]
        );

        $request->assertResponseStatus(302);
        $this->assertEquals($error->redirect->redirect_url, 'https://www.google.com');
    }
}