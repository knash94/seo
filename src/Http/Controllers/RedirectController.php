<?php

namespace Knash94\Seo\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\View\View;
use Knash94\Seo\Contracts\HttpRedirectsContract;
use Knash94\Seo\Http\Requests\RedirectRequest;

class RedirectController extends BaseController {

    /**
     * @var HttpRedirectsContract
     */
    protected $httpRedirects;

    function __construct(HttpRedirectsContract $httpRedirects)
    {
        $this->httpRedirects = $httpRedirects;
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
        $redirect = $this->httpRedirects->getRedirect($id);

        if (!$redirect) {
            abort(404);
        }

        return view(config('seo-tools.views.redirects.edit'), [
            'template' => config('seo-tools.views.template'),
            'section' => config('seo-tools.views.section'),
            'httpRedirect' => $redirect
        ]);
    }

    /**
     * Updates a current redirect
     *
     * @param $id
     * @param RedirectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, RedirectRequest $request)
    {
        $update = $this->httpRedirects->updateRedirect($id, $request->only(['redirect_url', 'status_code', 'path']));

        if ($update) {
            session()->flash('seo-tools.message', 'You have successfully updated the redirect.');
            return redirect()->route('seo-tools.index');
        }

        session()->flash('seo-tools.message', 'You have successfully updated the redirect.');
        return redirect()->back();
    }
}