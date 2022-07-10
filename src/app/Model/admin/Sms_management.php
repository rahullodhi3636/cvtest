<?php  
 	namespace App\Model\admin;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Support\Facades\DB;
	/**
	 * 
	 */
	class Sms_management extends Model
	{
		protected $table = 'sms_template';
		protected $primaryKey = 'id';
	    protected $fillable = [
	        'template_name',
	        'template_message',
	        'template_status'
	    ];
	}

?>