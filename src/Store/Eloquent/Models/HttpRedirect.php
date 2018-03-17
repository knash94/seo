<?php namespace Knash94\Seo\Store\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class HttpRedirect extends Model {

	protected $fillable = ['status_code', 'path', 'redirect_url'];

    /**
     * Returns the error the redirect belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function error()
    {
        return $this->belongsTo(HttpError::class, 'http_error_id');
	}
}
