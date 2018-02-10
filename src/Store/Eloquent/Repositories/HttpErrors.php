<?php

namespace Knash94\Seo\Store\Eloquent\Repositories;

use Carbon\Carbon;
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
        return $this->model->where('url', $url)->exists();
    }

    public function createUrlError($url)
    {
        return $this->model->create([
            'path' => $url,
            'hits' => 1,
            'last_hit' => Carbon::now()
        ]);
    }
}