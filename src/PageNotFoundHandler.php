<?php

namespace Knash94\Seo;


use Illuminate\Http\Request;
use Knash94\Seo\Contracts\HttpErrorsContract;
use Knash94\Seo\Contracts\HttpRedirectsContract;
use Knash94\Seo\Contracts\PageNotFoundHandlerContract;
use Knash94\Seo\Store\Eloquent\Models\HttpError;

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

    /**
     * @var HttpRedirectsContract
     */
    protected $httpRedirects;

    /**
     * PageNotFoundHandler constructor.
     * @param HttpErrorsContract $httpErrors
     * @param HttpRedirectsContract $httpRedirects
     * @param Request $request
     */
    function __construct(HttpErrorsContract $httpErrors, HttpRedirectsContract $httpRedirects, Request $request)
    {
        $this->httpErrors = $httpErrors;
        $this->request = $request;
        $this->httpRedirects = $httpRedirects;
    }

    /**
     * Handles an http exception
     *
     * @param \Exception $e
     * @return HttpError|mixed
     */
    public function handleHttpNotFoundException(\Exception $e)
    {
        $url = $this->request->path();

        if ($redirect = $this->httpRedirects->getUrlRedirect($url)) {
            return redirect()->to($redirect->redirect_url, $redirect->status_code);
        }

        if ($this->httpErrors->checkUrlExists($url)) {
            return $this->httpErrors->addHitToError($url);
        }

        return $this->httpErrors->createUrlError($url);
    }
}