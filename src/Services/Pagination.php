<?php

namespace Knash94\Seo\Services;


use Illuminate\Pagination\Paginator;

class Pagination
{
    protected $defaultPage = 'page';

    /**
     * Sets what page the pagination instance should look for, this is
     * usually defaulted to page. For example http://site.com?page=1
     *
     * @param string $page
     * @internal param string $page1
     */
    public function setPageParameter($page = 'page')
    {
        Paginator::currentPageResolver(function() use($page)
        {
            return app('request')->input($page);
        });
    }

    /**
     * Resets the pagination page resolver to the default ?page=1
     */
    public function resetPage()
    {
        Paginator::currentPageResolver(function()
        {
            return app('request')->input($this->defaultPage);
        });
    }
}