<?php
namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    protected $table = 'locations';
	protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];
}  
?>