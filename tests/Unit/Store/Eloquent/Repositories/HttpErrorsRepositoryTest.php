<?php

namespace Knash94\Seo\Tests\Unit\Store\Eloquent\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Knash94\Seo\Contracts\HttpErrorsContract;
use Knash94\Seo\Store\Eloquent\Models\HttpError;
use Knash94\Seo\Store\Eloquent\Models\HttpErrorRequest;
use Knash94\Seo\Store\Eloquent\Models\HttpRedirect;
use Knash94\Seo\Store\Eloquent\Repositories\HttpErrors;
use Knash94\Seo\Tests\Unit\TestCase;

class HttpErrorsRepositoryTest extends TestCase
{
    /** @test */
    public function it_binds_contract_to_repository()
    {
        $this->assertInstanceOf(HttpErrors::class, $this->getRepository());
    }

    /** @test */
    public function it_returns_null_if_error_does_not_exist()
    {
        $repository = $this->getRepository();

        $this->assertFalse($repository->checkUrlExists('/null'));
    }

    /** @test */
    public function it_checks_if_error_is_recorded_from_path()
    {
        $repository = $this->getRepository();

        factory(HttpError::class)->create([
            'path' => '/test'
        ]);

        $this->assertTrue($repository->checkUrlExists('/test'));
    }

    /** @test */
    public function it_create_error_from_path()
    {
        $repository = $this->getRepository();

        $request = $repository->createUrlError('/path');

        $this->assertInstanceOf(HttpErrorRequest::class, $request);
        $this->assertEquals('/path', $request->error->path);
    }

    /** @test */
    public function it_returns_null_if_no_error_is_passed_to_get_url_redirect()
    {
        $repository = $this->getRepository();

        $this->assertNull($repository->getUrlRedirect('/fake-url'));
    }

    /** @test */
    public function it_returns_redirect_from_to_get_url_redirect()
    {
        $repository = $this->getRepository();

        $error = factory(HttpError::class)->create([
            'path' => '/test'
        ]);

        factory(HttpRedirect::class)->create([
            'http_error_id' => $error->id,
            'path' => '/test'
        ]);

        $redirect = $repository->getUrlRedirect('/test');

        $this->assertInstanceOf(HttpRedirect::class, $redirect);
    }

    /** @test */
    public function it_adds_hit_to_an_error()
    {
        $repository = $this->getRepository();

        factory(HttpError::class)->create([
            'path' => '/test'
        ]);

        $request = $repository->addHitToError('/test');

        $this->assertEquals(2, $request->error->hits);
    }

    /** @test */
    public function it_returns_empty_array_if_no_errors_exist()
    {
        $repository = $this->getRepository();

        $this->assertEmpty($repository->getErrors());
    }

    /** @test */
    public function it_returns_paginated_errors()
    {
        $repository = $this->getRepository();

        factory(HttpError::class, 10)->create();

        $errors = $repository->getErrors();

        $this->assertInstanceOf(LengthAwarePaginator::class, $errors);
        $this->assertCount(10, $errors);
        $this->assertInstanceOf(HttpError::class, $errors->first());
    }

    /** @test */
    public function it_returns_errors_as_collection_and_not_paginated()
    {
        $repository = $this->getRepository();

        factory(HttpError::class, 10)->create();

        $errors = $repository->getErrors('hits', 'desc', false);

        $this->assertNotInstanceOf(LengthAwarePaginator::class, $errors);
        $this->assertInstanceOf(Collection::class, $errors);
        $this->assertCount(10, $errors);
        $this->assertInstanceOf(HttpError::class, $errors->first());
    }

    /** @test */
    public function it_gets_error_by_id()
    {
        $repository = $this->getRepository();

        $error = factory(HttpError::class)->create();

        $this->assertInstanceOf(HttpError::class, $repository->getError($error->id));
        $this->assertEquals($error->id, $repository->getError($error->id)->id);
    }

    /** @test */
    public function it_updates_an_error_redirect()
    {
        $repository = $this->getRepository();

        $error = factory(HttpError::class)->create([
            'path' => 'test'
        ]);

        $redirect = $repository->updateErrorRedirect($error->id, [
            'redirect_url' => 'https://google.com',
            'status_code' => 301,
            'path' => 'test'
        ]);

        $this->assertInstanceOf(HttpRedirect::class, $redirect);
    }

    /**
     * Builds and returns the repository
     *
     * @return HttpErrorsContract
     */
    protected function getRepository()
    {
        return app(HttpErrorsContract::class);
    }
}