<style>
  .expandit {
    position: fixed;
    overflow-y: scroll;
    top: 50px;
    bottom: 0;
}
</style>
<div class="sidebar expandit">
  <div class="profile-info">
    <nav> 
      <ul class="nav">
        <?php
          // print_r(Auth::user());
          $modules = DB::table('modules')->where('is_active',1)->orderBy('module_order','ASC')->get();
          $roles = DB::table('roles')->where('role_id',Auth::user()->department)->get(); 
          // dd($modules);
          if(Auth::user()->department==2){ 
            // echo '<label style="visibility:hidden">-</label>';
            ?>
            <li> <a href="{{url('recent_checkin')}}" class=""><i class="fa fa-paper-plane"></i> <span>NewCheck</span></a></li>
        <?php  } 
          if (!empty($modules)) {
            foreach ($modules as $module) { 
              $rolesPermission = DB::table('roles_permission')
              ->where('module_id',$module->module_id)
              ->where('role_id',$roles[0]->role_id)
              ->where('status',1)
              ->first();         
              if (!empty($rolesPermission)) {
            ?>
              <li><a href="{{ $module->module_url }}" class=""><?php echo $module->module_icon ?><span>{{ $module->module_name }}</span></a></li>
            <?php } }
            
          }
        ?>
        
        
      </ul>       
    </nav>
  </div> 
</div><!--./sidebar-->