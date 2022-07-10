<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Series extends Model
{
	protected $table = 'series';
	protected $primaryKey = 'id';
    protected $fillable = [
        'module_name',
        'series_type',
        'series_count',
    ];


}
?>
