<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Packages extends Model
{   
	protected $primaryKey = 'package_id';
    protected $fillable = [
        'firm_id',
        'package_title',
        'package_services',
        'package_price',
        'package_discount',
        'package_validity_type',
        'package_duration',
        'package_type',
        'total_member',
        'create_date',
        'package_satus'
    ];

    public static function serviceName($id)
    {
       // DB::enableQueryLog(); // Enable query log
       return DB::table('services')->where('id',$id)->first()->name;
       // return DB::table('packages')->find($id);
       // dd(DB::getQueryLog()); // Show results of log
    }

    public static function branchName($branchid)
    {
       return DB::table('firms')->where('id',$branchid)->first()->name;
    }

    public static function getPackage($id)
    {
        //dd($id);
        DB::enableQueryLog(); // Enable query log
        $package = DB::table('packages')
            ->join('branches', 'packages.branch_id', '=', 'branches.id')
            ->where('packages.package_id',$id)
            ->first();
            //dd(DB::getQueryLog()); // Show results of log
        return $package;    
    }

    public static function getPackageByBranch($id,$branch)
    {
        return DB::table('packages')->where('package_id',$id)->where('branch_id',$branch)->first();
    }
}
