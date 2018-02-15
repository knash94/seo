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
use Knash94\Seo\Http\Requests\ErrorRequest;

class ErrorsController extends BaseController {

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
    public function view($id, Request $request)
    {
        $error = $this->httpErrors->getError($id);

        if (!$error) {
            abort(404);
        }

        return view(config('seo-tools.views.errors.view'), [
            'template' => config('seo-tools.views.template'),
            'section' => config('seo-tools.views.section'),
            'httpError' => $error
        ]);
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
            'httpError' => $error
        ]);
    }

    /**
     * Updates a current 404 page
     *
     * @param $id
     * @param ErrorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, ErrorRequest $request)
    {
        $update = $this->httpErrors->updateError($id, $request->only(['redirect_url', 'status_code']));

        if ($update) {
            session()->flash('seo-tools.message', 'You have successfully updated the redirect.');
            return redirect()->route('seo-tools.index');
        }

        session()->flash('seo-tools.message', 'You have successfully updated the redirect.');
        return redirect()->back();
    }
}