<?php namespace Knash94\Seo\Store\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class HttpRedirect extends Model {

	protected $fillable = ['status_code', 'path', 'redirect_url'];
}