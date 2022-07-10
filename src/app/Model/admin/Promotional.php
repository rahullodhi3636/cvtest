<?php  
namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Promotional extends Model
{
	protected $table = 'promotional_offer_sms';
	protected $primaryKey = 'id';
    protected $fillable = [
        'offer_title',
        'contact_number',
        'offer_sms',
        'status',
    ];
}

?>