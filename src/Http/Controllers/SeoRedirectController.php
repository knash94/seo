<?php

namespace Knash94\Seo\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\View\View;
use Knash94\Seo\Contracts\HttpErrorsContract;
use Knash94\Seo\Contracts\HttpRedirectsContract;

class SeoRedirectController extends BaseController {

    /**
     * @var HttpErrorsContract
     */
    protected $httpErrors;

    /**
     * @var HttpRedirectsContract
     */
    protected $httpRedirects;

    function __construct(HttpErrorsContract $httpErrors, HttpRedirectsContract $httpRedirects)
    {
        $this->httpErrors = $httpErrors;
        $this->httpRedirects = $httpRedirects;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $errors = $this->getErrors($request);
        $redirects = $this->getRedirects($request);

        return view(config('seo-tools.views.index'), [
            'template' => config('seo-tools.views.template'),
            'section' => config('seo-tools.views.section'),
            'redirects' => $redirects,
            'errors' => $errors
        ]);
    }

    /**
     * Gets the data for HTTP Errors table
     *
     * @param $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    protected function getErrors($request)
    {
        $sort = $request->has('errors-sort') ? $request->get('errors-sort') : 'last_hit';
        $sortDir = $request->has('errors-sort-dir') ? $request->get('errors-sort-dir') : 'desc';

        return $this->httpErrors->getErrors($sort, $sortDir);
    }

    /**
     * Gets the data for HTTP Redirects table
     *
     * @param $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    protected function getRedirects($request)
    {
        $sort = $request->has('redirects-sort') ? $request->get('redirects-sort') : 'created_at';
        $sortDir = $request->has('redirects-sort-dir') ? $request->get('redirects-sort-dir') : 'desc';

        return $this->httpRedirects->getRedirects($sort, $sortDir);
    }
}