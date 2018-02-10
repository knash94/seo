<?php namespace Knash94\Seo\Store\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class HttpError extends Model {

    protected $dates = ['last_hit'];

    protected $fillable = ['path', 'hits', 'last_hit'];

    /**
     * Returns the redirect of the error page
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function redirect()
    {
        return $this->hasOne(HttpRedirect::class);
    }
}
