<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Manageusers extends Model
{
    protected $table = 'users';
	  protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'admin',
        'user_type',
        'lname',
        'parent_name',
        'phone_no',
        'mobile_no',
        'dob',
        'image',
        'aadharcard_number',
        'status'
    ];


   public static function getall(){
        $users = DB::table('users')
                ->select('users.*')
                ->where('users.id','!=',1)
                ->orderBy('users.id','DESC')
                ->get();
       return $users;
    }

    public static function getall_active(){
        $users = DB::table('users')
                ->select('users.*')
                ->where('users.status','=',1)
                ->where('users.id','!=',1)
                ->orderBy('users.id','DESC')
                ->get();
       return $users;
    }

    public static function getall_deactive(){
        $users = DB::table('users')
                ->select('users.*')
                ->where('users.status','=',0)
                 ->where('users.id','!=',1)
                ->orderBy('users.id','DESC')
                ->get();
       return $users;
    }



    public static function update_status($result_id,$data){
       $updatedRow = DB::table('users')->whereIn('id', $result_id)->update($data);
       return $updatedRow;
    }

    public static function update_user($data,$user_id){
      $update = DB::table('users')->where('id','=',$user_id)->update($data);
      return $update;
    }



}
