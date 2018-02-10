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

    /**
     * Handles an http exception
     *
     * @param \Exception $e
     */
    public function handleHttpNotFoundException(\Exception $e)
    {
        $url = $this->request->path();

        if ($this->httpErrors->checkUrlExists($url)) {
            return $this->handleHttpError($url);
        }

        return $this->createHttpError($url);
    }

    protected function createHttpError($url)
    {
        return $this->httpErrors->createUrlError($url);
    }

    protected function handleHttpError($url)
    {
    }
}