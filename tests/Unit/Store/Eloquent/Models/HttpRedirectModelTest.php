<?php

namespace Knash94\Seo\Tests\Unit\Store\Eloquent\Models;


use HttpRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Knash94\Seo\Store\Eloquent\Models\HttpError;
use Knash94\Seo\Store\Eloquent\Models\HttpErrorRequest;
use Knash94\Seo\Store\Eloquent\Models\HttpRedirect;
use Knash94\Seo\Tests\Unit\TestCase;

class HttpRedirectModelTest extends TestCase
{
    /** @test */
    public function it_gets_http_error()
    {
        $error = factory(HttpError::class)->create();
        $model = factory(HttpRedirect::class)->create([
            'http_error_id' => $error->id
        ]);

        $this->assertInstanceOf(BelongsTo::class, $model->error());
        $this->assertInstanceOf(HttpError::class, $model->error);
    }
}