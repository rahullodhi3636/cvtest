<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Final_invoice extends Model
{
	protected $table = 'final_invoice';
	protected $primaryKey = 'final_invoice_id';
    protected $fillable = [
        'user_id',
        'subtotal',
        'cgst',
        'sgst',
        'totalgstdiscount',
        'payment_mode',
        'total_discont_percent',
        'total_discount_value',
        'grand_total',
        'all_total',
        'paid_amount',
        'payable_amount',
        'remark',
        'invoice_type',
        'invoice_date',
        'payment_status',
        'status','checkin','is_estimate'
    ];


}
?>
