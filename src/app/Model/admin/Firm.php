<?php
namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Firm extends Model
{
	protected $table = 'firms';
	protected $primaryKey = 'id';
    protected $fillable = [
        'firm_name',
        'firm_location',
        'firm_number',
        'cgst',
        'sgst',
        'gst_status',
        'gst_discount',
        'qr_code',
        'composition',
        'composition_status',
        'invoice_count',
        'estimate_count',
        // 'services',
        'status'
    ];
}
?>
