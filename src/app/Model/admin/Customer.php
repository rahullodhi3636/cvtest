<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    protected $table = 'customers';
	protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id',
        'cust_type',
        'name',
        'customer_image',
        'location',
        'contact',
        'other_contact',
        'email',
        'dob',
        'gender',
        'designation',
        'referral_code',
        'referral_hash_code',
        'referred_by',
        'reward_points',
        'anniversary_date',
        'rf_id',
        'admin_id',
        'customer_code',
        'remark',
        'total_visit',
        'total_revenue',
        'avg_revenue',
        'last_visit_date',
        'total_reffer',
        'verify_otp',
        'customer_status','checkin'
    ];

    public static function getcusomertotalwalletbalance($customer_id){
        $wamount = DB::select('select sum(amount_allow) as total_amount,sum(amount_used) as used_amount from customer_wallet where customer_id='.$customer_id);
        $wbalance = 0;
        if(count($wamount)>0){
            $tamount = $wamount[0]->total_amount;
            $uamount = $wamount[0]->used_amount;
            $wbalance = $tamount-$uamount;
        }
        return $wbalance;
    }

}
