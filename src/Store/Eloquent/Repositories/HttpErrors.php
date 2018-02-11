<?php

namespace Knash94\Seo\Store\Eloquent\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Knash94\Seo\Contracts\HttpErrorsContract;
use Knash94\Seo\Services\Pagination;
use Knash94\Seo\Store\Eloquent\Models\HttpError;

class HttpErrors implements HttpErrorsContract
{
    protected $model;

    protected $pagination;

    function __construct(HttpError $model, Pagination $pagination)
    {
        $this->model = $model;
        $this->pagination = $pagination;
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

    /**
     * Gets the latest HTTP errors
     *
     * @param string $sort
     * @param string $direction
     * @param bool $paginate
     * @param int $perPage
     * @return LengthAwarePaginator|Collection
     */
    public function getErrors($sort = 'hits', $direction = 'desc', $paginate = true, $perPage = 12)
    {
        $query = $this->model
            ->orderBy($sort, $direction);

        if ($paginate) {
            $this->pagination->setPageParameter('errors');

            $results = $query->paginate($perPage, ['*'])->setPageName('errors');

            $this->pagination->resetPage();

            return $results;
        }

        return $query->get();
    }

    /**
     * Returns the HTTP Error
     *
     * @param $id
     * @return HttpError
     */
    public function getError($id)
    {
        return $this->model->find($id);
    }

    /**
     * Updates the redirect for an error
     *
     * @param $id
     * @param $data
     * @return \Illuminate\Database\Eloquent\Model|int|null
     */
    public function updateError($id, $data)
    {
        $model = $this->getError($id);

        if (!$model) {
            return null;
        }

        if ($model->redirect) {
            return $model->redirect()->update($this->refineRedirectData($data, $model));
        }

        return $model->redirect()->create($this->refineRedirectData($data, $model));
    }

    /**
     * Refines the redirect data to update or create a error's redirect
     *
     * @param $data
     * @param $model
     * @return array
     */
    protected function refineRedirectData($data, $model)
    {
        return [
            'redirect_url' => $data['redirect_url'],
            'status_code' => $data['status_code'],
            'path' => $model->path
        ];
    }
}