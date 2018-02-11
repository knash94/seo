<?php

namespace Knash94\Seo\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\View\View;
use Knash94\Seo\Contracts\HttpErrorsContract;

class SeoRedirectController extends BaseController {
    use DispatchesCommands, ValidatesRequests;

    /**
     * @var HttpErrorsContract
     */
    private $httpErrors;

    function __construct(HttpErrorsContract $httpErrors)
    {
        $this->httpErrors = $httpErrors;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $errors = $this->getErrors($request);

        return view(config('seo-tools.views.index'), [
            'template' => config('seo-tools.views.template'),
            'section' => config('seo-tools.views.section'),
            'errors' => $errors
        ]);
    }

    protected function getErrors($request)
    {
        $sort = $request->has('errors-sort') ? $request->get('errors-sort') : 'last_hit';
        $sortDir = $request->has('errors-sort-dir') ? $request->get('errors-sort-dir') : 'desc';

        return $this->httpErrors->getErrors($sort, $sortDir);
    }
}