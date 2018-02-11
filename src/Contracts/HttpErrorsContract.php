<?php

namespace Knash94\Seo\Contracts;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Knash94\Seo\Services\Pagination;
use Knash94\Seo\Store\Eloquent\Models\HttpError;

interface HttpErrorsContract
{
    /**
     * Checks whether a url has been logged before
     *
     * @param $url
     * @return bool
     */
    public function checkUrlExists($url);


    /**
     * Logs the HTTP error
     *
     * @param $url
     * @return HttpError
     */
    public function createUrlError($url);

    /**
     * Checks whether the url has a redirect
     *
     * @param $url
     * @return null
     */
    public function getUrlRedirect($url);

    /**
     * Adds a hit to the error
     *
     * @param $url
     * @return mixed
     */
    public function addHitToError($url);

    /**
     * Gets the latest HTTP errors
     *
     * @param string $sort
     * @param string $direction
     * @param bool $paginate
     * @param int $perPage
     * @return LengthAwarePaginator|Collection
     */
    public function getErrors($sort = 'hits', $direction = 'desc', $paginate = true, $perPage = 12);
}