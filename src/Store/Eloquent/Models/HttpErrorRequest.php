<?php namespace Knash94\Seo\Store\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class HttpErrorRequest extends Model {

    protected $dates = ['last_hit'];

    protected $fillable = ['user_agent', 'ip_address', 'previous_url'];

    /**
     * Returns the redirect of the error page
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function error()
    {
        return $this->hasOne(HttpError::class, 'http_error_id');
    }
}
