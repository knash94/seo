<?php

namespace Knash94\Seo\Tests\Unit\Store\Eloquent\Models;


use HttpRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Knash94\Seo\Store\Eloquent\Models\HttpError;
use Knash94\Seo\Store\Eloquent\Models\HttpErrorRequest;
use Knash94\Seo\Store\Eloquent\Models\HttpRedirect;
use Knash94\Seo\Tests\Unit\TestCase;

class HttpErrorModelTest extends TestCase
{
    /** @test */
    public function it_has_redirect_relationship()
    {
        $model = new HttpError();
        $this->assertInstanceOf(HasOne::class, $model->redirect());
    }

    /** @test */
    public function it_has_requests_relationship()
    {
        $model = new HttpError();
        $this->assertInstanceOf(HasMany::class, $model->requests());
    }

    /** @test */
    public function it_gets_redirect()
    {
        $model = factory(HttpError::class)->create();
        factory(HttpRedirect::class)->create([
            'http_error_id' => $model->id
        ]);

        $this->assertInstanceOf(HttpRedirect::class, $model->redirect);
    }

    /** @test */
    public function it_gets_requests()
    {
        $model = factory(HttpError::class)->create();

        factory(HttpErrorRequest::class, 10)->create([
            'http_error_id' => $model->id
        ]);

        $this->assertInstanceOf(Collection::class, $model->requests);

        $this->assertInstanceOf(HttpErrorRequest::class, $model->requests->first());
    }
}