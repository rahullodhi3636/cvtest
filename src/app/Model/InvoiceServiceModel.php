<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceServiceModel extends Model
{
	protected $table = 'invoice_service';
	protected $primaryKey = 'invoice_service_id';
    protected $fillable = [
        'invoice_id',
        'brand_id',
        'firm_id',
        'service_id',
        'staff_id',
        'quantity',
        'price',
        'service_add',
        'discount',
        'cgst',
        'sgst',
        'gstdiscount',
        'composition',
        'total_price',
        'free_service',
        'offer_id',
        'service_status','other_service_id'
    ];
}
?>
