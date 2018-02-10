<?php

namespace Knash94\Seo\Store\Eloquent\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Knash94\Seo\Contracts\HttpErrorsContract;
use Knash94\Seo\Store\Eloquent\Models\HttpError;

class HttpErrors implements HttpErrorsContract
{
    protected $model;

    function __construct(HttpError $model)
    {
        $this->model = $model;
    }

    /**
     * Checks whether a url has been logged before
     *
     * @param $url
     * @return bool
     */
    public function checkUrlExists($url)
    {
        return $this->model->where('path', $url)->exists();
    }

    /**
     * Logs the HTTP error
     *
     * @param $url
     * @return HttpError
     */
    public function createUrlError($url)
    {
        return $this->model->create([
            'path' => $url,
            'hits' => 1,
            'last_hit' => Carbon::now()
        ]);
    }

    /**
     * Checks whether the url has a redirect
     *
     * @param $url
     * @return null
     */
    public function getUrlRedirect($url)
    {
        $model = $this->model
            ->where('path', $url)
            ->with(['redirect'])
            ->first();

        if (!$model) {
            return null;
        }

        if ($model->redirect) {
            return $model->redirect;
        }

        return null;
    }

    /**
     * Adds a hit to the error
     *
     * @param $url
     * @return mixed
     */
    public function addHitToError($url)
    {
        return $this->model->where('path', $url)->update([
            'hits' => DB::raw('hits + 1'),
            'last_hit' => Carbon::now()
        ]);
    }
}