<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MemberSystem extends Model
{
    public $timestamps = false;
    protected $table = 'membersystem';
	protected $primaryKey = 'id';
    protected $fillable = [
        'membership_name',
        'membership_type',
        'discount_type','minimum_req_amt',
        'membership_discount',
        'membership_validity',
        'membership_price',
        'created',
    ];
}
