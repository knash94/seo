<?php

namespace Knash94\Seo\Store\Eloquent\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Knash94\Seo\Contracts\HttpRedirectsContract;
use Knash94\Seo\Services\Pagination;
use Knash94\Seo\Store\Eloquent\Models\HttpRedirect;

class HttpRedirects implements HttpRedirectsContract
{

    /**
     * @var HttpRedirect
     */
    protected $model;
    /**
     * @var Pagination
     */
    protected $pagination;

    function __construct(HttpRedirect $model, Pagination $pagination)
    {
        $this->model = $model;
        $this->pagination = $pagination;
    }

    /**
     * Gets the latest HTTP redirects
     *
     * @param string $sort
     * @param string $direction
     * @param bool $paginate
     * @param int $perPage
     * @return LengthAwarePaginator|Collection
     */
    public function getRedirects($sort = 'hits', $direction = 'desc', $paginate = true, $perPage = 12)
    {
        $query = $this->model
            ->orderBy($sort, $direction);

        if ($paginate) {
            $this->pagination->setPageParameter('redirects');

            $results = $query->paginate($perPage)->setPageName('redirects');

            $this->pagination->resetPage();

            return $results;
        }

        return $query->get();
    }
}