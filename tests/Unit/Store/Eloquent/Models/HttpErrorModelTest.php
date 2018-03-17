<?php

namespace Knash94\Seo\Tests\Unit\Store\Eloquent\Models;


use Illuminate\Database\Eloquent\Relations\HasOne;
use Knash94\Seo\Store\Eloquent\Models\HttpError;
use Knash94\Seo\Tests\Unit\TestCase;

class HttpErrorModelTest extends TestCase
{
    /** @test */
    public function it_has_redirect_relationship()
    {
        $model = new HttpError();
        $this->assertInstanceOf(HasOne::class, $model->redirect());
    }
}