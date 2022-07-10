<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CustomerSittingPack extends Model
{
    public $timestamps = false;
    protected $table = 'customer_sitting_pack';
	protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id', 'sittingpack_id', 'member_name','member_mobile','expire_date','member_otp',
        'packageAdvancePayment','status','invoice_id','alternative_phone','full_address','sitpack_final_price'
    ];
}
