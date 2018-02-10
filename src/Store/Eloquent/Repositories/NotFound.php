<?php

namespace Knash94\Seo\Store\Eloquent\Repositories;


use Illuminate\Http\Request;
use Knash94\Seo\Contracts\NotFoundContract;

class NotFound implements NotFoundContract
{
    /**
     * @var Request
     */
    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handleHttpNotFoundException(\Exception $e)
    {
        $url = $this->request->path();

        // Check if path has been logged before

        // Check if path has redirect, if so then redirect

        // If not, create the 404 database entry

        // If exists and not actioned, then increase the hits by one
    }
}