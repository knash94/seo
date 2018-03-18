<?php

namespace Knash94\Seo\Tests\Unit\Exception;

use Exception;
use Illuminate\Http\RedirectResponse;
use Knash94\Seo\Traits\LogsMissingPages;

class Handler extends \Orchestra\Testbench\Exceptions\Handler
{
    /**
     * This class is made to emulate an applications handler.php for testing purposed only.
     */

    use LogsMissingPages;

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $redirect = $this->reportNotFound($e);

        if ($redirect && $redirect instanceof RedirectResponse) {
            return $redirect;
        }

        return parent::render($request, $e);
    }
}