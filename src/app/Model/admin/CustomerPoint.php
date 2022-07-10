<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CustomerPoint extends Model
{
    public $timestamps = false;
    protected $table = 'customer_points';
	protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id',
        'invoice_id',
        'points'
    ];
}
