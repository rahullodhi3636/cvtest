<?php
namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Designation extends Model
{
	protected $table = 'designations';
	protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];
}  
?>