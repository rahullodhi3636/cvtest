<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FeedbackByStaff extends Model
{   
    protected $table = 'feedback_bystaff';
	protected $primaryKey = 'staff_feedback_id';
    protected $fillable = [
        'customer_id','staff_id',
        'rating', 'comment',
        'status','cust_rating','cust_comment','invoice_id'
    ];
}
