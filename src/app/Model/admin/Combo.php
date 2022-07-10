<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    public $timestamps = false; 
    protected $table = 'combo';
	protected $primaryKey = 'id';
    protected $fillable = [
        'combo_name',
        'combo_price',
        'combo_total',
        'created_at'
    ];
}
