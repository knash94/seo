<?php

namespace Knash94\Seo\Contracts;


interface HttpErrorsContract
{

    /**
     * Checks whether a url has been logged before
     *
     * @param $url
     * @return bool
     */
    public function checkUrlExists($url);
}