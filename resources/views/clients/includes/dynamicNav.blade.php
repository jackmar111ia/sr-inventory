<?php 


//dd($guardName);
if($guardName == "admin")
$roleInfo = permissions(1);

else if($guardName == "moderator")
$roleInfo = permissions(3);

else 
$roleInfo = permissions(2);

// dd($roleInfo);
$roleKeyword = $roleInfo->role_keyword;
$permissionIds = explodePermissionIds($roleInfo->general_permissions); 
 

//echo "$roleKeyword, $roleInfo->general_permissions";


$lval =  "";

$PMenu = DB::table('navigation')
->where('route_name',$lval)
->first();



if($roleKeyword == "owner_primary")
    { 
        $accType = explodeList("moderator_admin,moderator"); 
        $r1 = DB::table('navigation')
        ->where('menu_step',0)
        ->where('status','publish')
        ->whereIn('account_type',$accType)
        ->orderBy('morder','ASC')
        ->get();
    }

    else
    {
        // if super admin
        
        $accType = explodeList("client"); 
        $r1 = DB::table('navigation')
        ->where('menu_step',0)
        ->where('status','publish')
        //->whereIn('id',$permissionIds)
         ->whereIn('account_type',$accType)
        ->orderBy('morder','ASC')
        ->get();
    }
    
        

         
foreach($r1 as $rr1)
{ // foreach starts

    if(Request::routeIs($rr1->route_name."*"))
    $headstatus = 'active';
    else 
    $headstatus = '';

    $menuName =  $rr1->menu_name; 

?>
   


    <li  class="nav-item <?php echo $headstatus; ?>">
        <a href="
        <?php   if($rr1->down_link_exist == "no")  
        echo URL::route( $rr1->route_name);
        else echo "#";
        ?> 
        
        " class="nav-link <?php   if($rr1->down_link_exist == "yes") {?> nav-toggle  <?php } ?>">
            <i class="<?php  echo $rr1->fa_icon;?>"></i>
            <span class="title">   <?php  echo  txt($menuName); ?> </span>
            <?php   if($rr1->down_link_exist=="yes") {?> 
            <span class="selected"></span>
            <span class="arrow open"></span>
            <?php } ?>
        </a>

        <?php   if($rr1->down_link_exist=="yes") {?> 
            <ul class="sub-menu">
                <?php seond_levels($rr1->id,$lval,$roleInfo); ?>
            </ul>
        <?php } ?>

    </li>


                
<?php  
}  
?> 
      
<?php		
function seond_levels($sl,$pageval,$roleInfo)
{
    
    $roleKeyword = $roleInfo->role_keyword;
    $permissionIds = explodePermissionIds($roleInfo->general_permissions); 

     
if($roleKeyword == "owner_primary")
    {
      
    $accType = explodeList("moderator_admin,moderator"); 
        $r1=DB::table('navigation')
        ->where('parent',$sl)
        ->where('menu_step','>',0)
        ->where('status','publish')
        ->whereIn('account_type',$accType)
       // ->orderBy('id','ASC')
        ->orderBy('morder','ASC')
        ->get();
    }

    else
    {
        $accType = explodeList("client"); 

        $r1=DB::table('navigation')
        ->where('parent',$sl)
        ->where('menu_step','>',0)
        ->where('status','publish')
        //->whereIn('id',$permissionIds)
          ->whereIn('account_type',$accType)
        //->orderBy('id','ASC')
        ->orderBy('morder','ASC')
        ->get();
    }


foreach($r1 as $rr1)
{
   if(Request::routeIs($rr1->route_name."*"))
    $headstatus = 'active';
    else 
    $headstatus = '';

    $menuName =  $rr1->menu_name; 

    ?>
     

    <li  class="nav-item  <?php echo $headstatus; ?> ">
        <a href="
        <?php   if($rr1->down_link_exist == "no")  
        echo URL::route( $rr1->route_name);
        else echo "#";
        ?> 
        " 
        
        class="nav-link <?php   if($rr1->down_link_exist == "yes") {?> nav-toggle<?php } ?>">
            <i class="<?php  echo $rr1->fa_icon;?>"></i>
            <span class="title"> <?php  echo  txt($menuName); ?> </span>

            <?php   if($rr1->down_link_exist == "yes") {?> 
            <span class="selected"></span>
            <span class="arrow open"></span>
            <?php } ?>
        </a>
            <?php   if($rr1->down_link_exist == "yes") {?> 
            <ul class="sub-menu">
                <?php seond_levels($rr1->id,$pageval,$roleInfo); ?>
                    
            </ul>
            <?php } ?>

    </li>




<?php  
} 
      

return("");
} 

?>


<?php /*
  // multi level menu

<li class="nav-item start {{ (request()->routeIs('profile*'))  ? 'active' : '' }}">
    <a href="#" class="nav-link nav-toggle">
        <i class="fas fa-user"></i>
        <span class="title">{{ __('profile') }}</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{ (request()->routeIs('profile.one*'))  ? 'active' : '' }}">
            <a href="{{ route('profile.one') }}" class="nav-link ">
                <span class="title">{{ __('Profile one') }}</span>
            </a>
        </li>
        <li class="nav-item {{ (request()->routeIs('profile.two*'))  ? 'active' : '' }}">
            <a href="#" class="nav-link nav-toggle">
                <span class="title">{{ __('Profile two') }}</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>

                <ul class="sub-menu">
                    <li class="nav-item {{ (request()->routeIs('profile.two.child1*'))  ? 'active' : '' }}">
                        <a href="{{ route('profile.two.child1') }}" class="nav-link">
                        <i class="fa fa-calculator"></i> Pro two - child one</a>
                    </li>
                    <li  class="nav-item {{ (request()->routeIs('profile.two.child2*'))  ? 'active' : '' }}">
                        <a href="{{ route('profile.two.child2') }}" class="nav-link">
                        <i class="fa fa-clone"></i> Pro two - child two</a>
                    </li>

                    <li  class="nav-item {{ (request()->routeIs('profile.two.child3*'))  ? 'active' : '' }}">
                        <a href="#" class="nav-link nav-toggle">
                            <span class="title">{{ __('Pro two - child three') }}</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>

                            <ul class="sub-menu">
                                <li class="nav-item {{ (request()->routeIs('profile.two.child3.childone*'))  ? 'active' : '' }}">
                                    <a href="{{ route('profile.two.child3.childone') }}" class="nav-link">
                                    <i class="fa fa-calculator"></i>Pro two - child three -one</a>
                                </li>
                                <li  class="nav-item {{ (request()->routeIs('profile.two.child3.childtwo*'))  ? 'active' : '' }}">
                                    <a href="{{ route('profile.two.child3.childtwo') }}" class="nav-link">
                                    <i class="fa fa-clone"></i>Pro two - child three -two</a>
                                </li>
                            </ul>

                    </li>

                    
                </ul>

        </li>
    </ul>
</li>
 */?>