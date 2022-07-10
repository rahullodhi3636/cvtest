<?php  
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceRemainingModel extends Model
{
	protected $table = 'invoice_remaining_amount';
	protected $primaryKey = 'invoice_remaining_amount_id';
    protected $fillable = [
        'invoice_id',
        'user_id',
        'paid_amount',
        'remaining_amount',
        'payment_mode',
        'status'
    ];
}
?>