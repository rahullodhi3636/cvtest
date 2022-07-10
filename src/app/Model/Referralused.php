<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Referralused extends Model
{
	protected $table = 'referral_used';
	protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id',
        'invoice_id',
        'offer_id',
        'offer_code',
        'used_by',
        'used_date'
    ];


    public static function checkfreeservice($customer_id){
        $freeservices = DB::table('referral_used')
                ->select('referral_used.*','customers.name as referred_customer_name')
                ->leftJoin('customers','customers.id','=','referral_used.customer_id')
                ->where('referral_used.used_by',$customer_id)
                ->first();
       return $freeservices;
    }
}
?>
