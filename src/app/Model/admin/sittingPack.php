<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class sittingPack extends Model
{
    public $timestamps = false; 
    protected $table = 'sittingpack';
	protected $primaryKey = 'id';
    protected $fillable = [
        'pack_name',
        'total_members',
        'grand_total',
        'pack_final_price'
    ];
}
