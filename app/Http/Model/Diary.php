<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
	protected $table = 'diary';
	protected $primaryKey = 'id';

	public $timestamps = false;

	protected $guarded = [];

}
