<?php  
namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Changepassword extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'phone_no',
        'status'
    ];
}
?>