<?php

namespace Knash94\Seo\Contracts;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface HttpRedirectsContract
{
    /**
     * Gets the latest HTTP errors
     *
     * @param string $sort
     * @param string $direction
     * @param bool $paginate
     * @param int $perPage
     * @return LengthAwarePaginator|Collection
     */
    public function getRedirects($sort = 'hits', $direction = 'desc', $paginate = true, $perPage = 12);
}