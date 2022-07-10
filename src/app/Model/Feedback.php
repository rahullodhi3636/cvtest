<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Feedback extends Model
{   
    protected $table = 'feedback';
	protected $primaryKey = 'feedback_id';
    protected $fillable = [
        'customer_id',
        'rating',
        'comment',
        'status'
    ];
}
