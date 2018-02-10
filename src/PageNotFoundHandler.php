<?php

namespace Knash94\Seo;


use Illuminate\Http\Request;
use Knash94\Seo\Contracts\HttpErrorsContract;
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

    function __construct(HttpErrorsContract $httpErrors, Request $request)
    {
        $this->httpErrors = $httpErrors;
        $this->request = $request;
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

        if ($this->httpErrors->checkUrlExists($url)) {
            return $this->handleHttpError($url);
        }

        return $this->createHttpError($url);
    }

    /**
     * Creates the http error record
     *
     * @param $url
     * @return HttpError
     */
    protected function createHttpError($url)
    {
        return $this->httpErrors->createUrlError($url);
    }

    /**
     *
     *
     * @param $url
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function handleHttpError($url)
    {
        if ($redirect = $this->httpErrors->getUrlRedirect($url)) {
            return redirect()->to($redirect->redirect_url, $redirect->status_code);
        }

        $this->httpErrors->addHitToError($url);
    }
}