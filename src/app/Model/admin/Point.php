<?php

// namespace App;
namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Point extends Model
{
    protected $table = 'points';
	protected $primaryKey = 'id';
    protected $fillable = [
        'invoice_amt',
        'point_amt'
    ];
}
