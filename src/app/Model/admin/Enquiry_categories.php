<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Enquiry_categories extends Model
{   
	protected $primaryKey = 'id';
    protected $fillable = [
        'admin_id',
        'category',
        'created_at',
        'is_active'
    ];
}
