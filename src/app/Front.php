<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Front extends Model
{
    
   public static function brandings(){
          $latest_news = DB::table('mall_brandings')
             ->select('*')
             ->where('status','=',1)
             ->orderBy('id','DESC')
             ->get(); 
          return $latest_news;
    }

}
