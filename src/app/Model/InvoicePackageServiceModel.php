<?php  
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoicePackageServiceModel extends Model
{
	
	protected $table = 'invoice_package_service';
	protected $primaryKey = 'invoice_package_service_id';
    protected $fillable = [
        'invoice_package_id',
        'service_id',
        'quantity',
        'total',
        'use_status',
    ];
}
?>