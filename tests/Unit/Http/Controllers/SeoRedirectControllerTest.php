<?php
namespace Knash94\Seo\Tests\Unit\Http\Controllers;

use Knash94\Seo\Store\Eloquent\Models\HttpError;
use Knash94\Seo\Tests\Unit\TestCase;

class SeoRedirectControllerTest extends TestCase
{
    /** @test */
    public function it_returns_404_if_id_does_not_exist()
    {
        $request = $this->get(route('seo-tools.index'));

        $request->assertResponseStatus(200);
        $request->seeText('Redirect Manager');
    }
}