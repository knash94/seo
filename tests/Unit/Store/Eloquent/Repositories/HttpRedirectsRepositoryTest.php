<?php

namespace Knash94\Seo\Tests\Unit\Store\Eloquent\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Knash94\Seo\Contracts\HttpErrorsContract;
use Knash94\Seo\Contracts\HttpRedirectsContract;
use Knash94\Seo\Store\Eloquent\Models\HttpError;
use Knash94\Seo\Store\Eloquent\Models\HttpErrorRequest;
use Knash94\Seo\Store\Eloquent\Models\HttpRedirect;
use Knash94\Seo\Store\Eloquent\Repositories\HttpErrors;
use Knash94\Seo\Store\Eloquent\Repositories\HttpRedirects;
use Knash94\Seo\Tests\Unit\TestCase;

class HttpRedirectsRepositoryTest extends TestCase
{
    /** @test */
    public function it_binds_contract_to_repository()
    {
        $this->assertInstanceOf(HttpRedirects::class, $this->getRepository());
    }

    /** @test */
    public function it_checks_if_redirect_url_exists()
    {
        $repository = $this->getRepository();

        $redirect = factory(HttpRedirect::class)->create([
            'path' => 'test'
        ]);

        $repositoryRedirect = $repository->getUrlRedirect('test');

        $this->assertEquals($redirect->id, $repositoryRedirect->id);
    }

    /** @test */
    public function it_gets_empty_collection_of_redirects()
    {
        $repository = $this->getRepository();

        $redirects = $repository->getRedirects();

        $this->assertEmpty($redirects);
    }

    /** @test */
    public function it_gets_paginated_redirects()
    {
        $repository = $this->getRepository();

        factory(HttpRedirect::class, 5)->create();

        $redirects = $repository->getRedirects();

        $this->assertInstanceOf(LengthAwarePaginator::class, $redirects);
        $this->assertInstanceOf(HttpRedirect::class, $redirects->first());
        $this->assertCount(5, $redirects);
    }

    /** @test */
    public function it_gets_collection_of_redirects()
    {
        $repository = $this->getRepository();

        factory(HttpRedirect::class, 5)->create();

        $redirects = $repository->getRedirects('hits', 'dsec', false);

        $this->assertNotInstanceOf(LengthAwarePaginator::class, $redirects);
        $this->assertInstanceOf(Collection::class, $redirects);
        $this->assertInstanceOf(HttpRedirect::class, $redirects->first());
        $this->assertCount(5, $redirects);
    }

    /** @test */
    public function it_gets_redirect_by_id()
    {
        $repository = $this->getRepository();

        $redirect = factory(HttpRedirect::class)->create();

        $repositoryRedirect = $repository->getRedirect($redirect->id);

        $this->assertEquals($redirect->id, $repositoryRedirect->id);
    }

     /** @test */
    public function it_returns_null_if_cant_find_redirect_by_id()
    {
        $repository = $this->getRepository();

        $repositoryRedirect = $repository->getRedirect(1);

        $this->assertNull($repositoryRedirect);
    }

    /** @test */
    public function it_destroys_a_redirect()
    {
        $repository = $this->getRepository();

        $redirect = factory(HttpRedirect::class)->create();

        $this->assertTrue($repository->destroy($redirect->id));
    }


    /** @test */
    public function it_updates_a_redirect()
    {
        $repository = $this->getRepository();

        $redirect = factory(HttpRedirect::class)->create([
            'path' => 'test'
        ]);

        $repositoryRedirect = $repository->updateRedirect($redirect->id, [
            'path' => 'new-path',
            'redirect_url' => 'https://google.com',
            'status_code' => 301
        ]);

        $redirect = $redirect->fresh();

        $this->assertTrue($repositoryRedirect);
        $this->assertEquals('new-path', $redirect->path);
    }

    /** @test */
    public function it_creates_a_redirect()
    {
        $repository = $this->getRepository();

        $repositoryRedirect = $repository->createRedirect([
            'path' => 'test-path',
            'redirect_url' => 'https://google.com',
            'status_code' => 301
        ]);

        $this->assertInstanceOf(HttpRedirect::class, $repositoryRedirect);
        $this->assertEquals('test-path', $repositoryRedirect->path);
    }


    /**
     * Builds and returns the repository
     *
     * @return HttpRedirectsContract
     */
    protected function getRepository()
    {
        return app(HttpRedirectsContract::class);
    }
}