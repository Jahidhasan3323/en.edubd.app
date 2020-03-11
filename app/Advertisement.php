<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
	protected $fillable = [
			'top_banner_advertisement',
			'slider_bottom_advertisement',
			'footer_advertisement',
			'slider_right_advertisement',
			'slider_left_advertisement',
			'sitebar_right_advertisement',
			'sitebar_bottom_advertisement',
	    ];
}
