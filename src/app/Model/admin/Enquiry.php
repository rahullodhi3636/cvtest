<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Enquiry extends Model
{
    protected $table = 'enquiries';
	protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'category_id',
        'package_id',
        'name',
        'email',
        'contact',
        'address',
        'remark',
        'date',
        'sid','enq_for','description','status'
    ];
}
