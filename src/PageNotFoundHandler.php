<?php

namespace Knash94\Seo;


use Illuminate\Http\Request;
use Knash94\Seo\Contracts\HttpErrorsContract;
use Knash94\Seo\Contracts\PageNotFoundHandlerContract;

class PageNotFoundHandler implements PageNotFoundHandlerContract
{
    /**
     * @var HttpErrorsContract
     */
    protected $httpErrors;

    /**
     * @var Request
     */
    protected $request;

    function __construct(HttpErrorsContract $httpErrors, Request $request)
    {
        $this->httpErrors = $httpErrors;
        $this->request = $request;
    }

    public function handleHttpNotFoundException(\Exception $e)
    {
        $url = $this->request->path();

        // Check if path has been logged before

        // Check if path has redirect, if so then redirect

        // If not, create the 404 database entry

        // If exists and not actioned, then increase the hits by one
    }
}