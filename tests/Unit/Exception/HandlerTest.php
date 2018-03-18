<?php

namespace Knash94\Seo\Tests\Unit\Exception;


use Knash94\Seo\Store\Eloquent\Models\HttpError;
use Knash94\Seo\Store\Eloquent\Models\HttpRedirect;
use Knash94\Seo\Tests\Unit\TestCase;

class HandlerTest extends TestCase
{
    /** @test */
    public function it_logs_404_pages()
    {
        $request = $this->get('/test');


        $request->assertResponseStatus(404);

        $this->assertTrue(HttpError::where('path', 'test')->exists());
    }

    /** @test */
    public function it_redirects_404()
    {
        factory(HttpRedirect::class)->create([
            'path' => 'test',
            'redirect_url' => 'https://www.google.com',
            'status_code' => 302
        ]);

        $request = $this->get('/test');

        $request->assertResponseStatus(302);
        $request->assertRedirectedTo('https://www.google.com');
    }
}