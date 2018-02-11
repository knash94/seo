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

class ErrorsController extends BaseController {
    use DispatchesCommands, ValidatesRequests;

    /**
     * @var HttpErrorsContract
     */
    protected $httpErrors;

    function __construct(HttpErrorsContract $httpErrors)
    {
        $this->httpErrors = $httpErrors;
    }

    /**
     * Shows the page to edit
     *
     * @param $id
     * @param Request $request
     * @return View
     */
    public function edit($id, Request $request)
    {
        $error = $this->httpErrors->getError($id);

        if (!$error) {
            abort(404);
        }

        return view(config('seo-tools.views.errors.edit'), [
            'template' => config('seo-tools.views.template'),
            'section' => config('seo-tools.views.section'),
            'error' => $error
        ]);
    }
}