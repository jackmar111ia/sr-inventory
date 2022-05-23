<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\wpData;
use App\Models\admin\Layouts;
use Codexshaper\WooCommerce\Facades\Customer;
use DB;
use Session;
use Auth;
use PDF;
class ReportsController extends Controller
{
   public function canadaReportCreate(){

        $q = wpData::get(); 
        $q = wpData::where('view_status','yes')->orderBy('serial')->get();
        //$view_type = view_type::all();
        //return view('admin.wpdatamanage.rearrange',compact('all','view_type'));
        return view('admin.reports.management.canada',compact('q'));
   }
   public function ontarioReportCreate(){
    $q = wpData::get();
    return view('admin.reports.management.ontario',compact('q'));
   }
   

   public function rerortSave(Request $request){
        $id = [];
        $type = $request->type;
        //dd($request->id);
        if($request->id!=''){
            foreach($request->id as $q){
            array_push($id, $q); 
            } 
        }
        $idQty = $request->id;
        //dd($request->all(),$id,$idQty);
         $this->row_show_status_update($type,$id);

        if($type == "canada")
        return redirect()->route('admin.report.head.list.canada')->with('success','Report been updated successfully!');  
        else
        return redirect()->route('admin.report.head.list.ontario')->with('success','Report been updated successfully!');  

   }
   private function row_show_status_update($show_type,$array){
    if($show_type == "canada")
    $field_name = "canada_view";
    else
    $field_name = "ontario_view";

    DB::table('wp_data')
           ->update([
            $field_name => '' 
          ]);

     
     
    for($i=0;$i<count($array); $i++){
       // echo $array[$i];
        $q = wpData::Find($array[$i]);
        $q->$field_name = 'yes';
        $q->save();
     } 
    
     return " ";
   }
   public function setupCategory(){
        $category = request()->get('category');
        $q = Layouts::where('list_category',$category)->first();
        $option = "report_setup_view";

        return view('admin.reports.ajax.results',compact('option','q'));
   }
   public function list($type = null){

        if(Auth::guard('admin')->check() == 1){
            if($type == "ontario"){
                $qtype= "ontario_view";
                $type = "ontario";
            }
            else {
                $qtype= "canada_view";
                $type = "canada";
            }
        
        // dd($type,$qtype);
        $q1 = Layouts::where('list_category',$type)->first();
        
        
            //dd($q1);
            if($q1->sort_category == "price"){
                if($type == "canada")
                $sort_category = "canada_price";
                else
                $sort_category = "ontario_price";
        
                $sort_type = $q1->sort_type;
            }
        
            //$q = wpData::where($qtype,'yes')->orderBy($sort_category,$sort_type)->paginate(10);
            $q = wpData::where('view_type',$type)->orWhere('view_type','both')->where('view_status','yes')->orderBy('serial')->get();
            //dd($q);
            return view('front.prlist',compact('q','q1','type'));
        }else{


            $guestSession = Session::get('GuestSesId');
            //dd($guestSession);
            if($guestSession != ""){
                if($type == "ontario"){
                    $qtype= "ontario_view";
                    $type = "ontario";
                }
                else {
                    $qtype= "canada_view";
                    $type = "canada";
                }
            
            // dd($type,$qtype);
            $q1 = Layouts::where('list_category',$type)->first();
            
            
                //dd($q1);
                if($q1->sort_category == "price"){
                    if($type == "canada")
                    $sort_category = "canada_price";
                    else
                    $sort_category = "ontario_price";
            
                    $sort_type = $q1->sort_type;
                }
            
                //$q = wpData::where($qtype,'yes')->orderBy($sort_category,$sort_type)->paginate(10);
                $q = wpData::where('view_type',$type)->orWhere('view_type','both')->where('view_status','yes')->orderBy('serial')->get();
                //dd($q);
                return view('front.prlist',compact('q','q1','type'));
            }else{
                return redirect()->route('denied.access');  
                
            }

        }
          
         
        
   

   
   }


   public function downloadPdf($type){
    
   $q1 = Layouts::where('list_category',$type)->first();
   //dd($q1);
   
       //dd($q1);
       if($q1->sort_category == "price"){
           if($type == "canada")
           $sort_category = "canada_price";
           else
           $sort_category = "ontario_price";
   
           $sort_type = $q1->sort_type;
       }
   
       //$q = wpData::where($qtype,'yes')->orderBy($sort_category,$sort_type)->paginate(10);
       $q = wpData::where('view_type',$type)->orWhere('view_type','both')->where('view_status','yes')->orderBy('serial')->get();
    
    //dd($items);
    view()->share(compact('q','q1','type'));

    $pdf = PDF::loadView('prlist_pdf');
    $pdfname = "Product_list_$type.pdf";
     return $pdf->download($pdfname);

}

public function generatePDFView($type){
    
    $q1 = Layouts::where('list_category',$type)->first();
     
    
        //dd($q1);
        if($q1->sort_category == "price"){
            if($type == "canada")
            $sort_category = "canada_price";
            else
            $sort_category = "ontario_price";
    
            $sort_type = $q1->sort_type;
        }
    
        //$q = wpData::where($qtype,'yes')->orderBy($sort_category,$sort_type)->paginate(10);
        $q = wpData::where('view_type',$type)->orWhere('view_type','both')->where('view_status','yes')->orderBy('serial')->get();
        return view('prlist_pdf',compact('q','q1','type'));
     
 
 }
 
 



 


   public function setupManagement(){
       
        return view('admin.reports.head.setup');
   }
   public function setupManagementSave(Request $request){
       //dd($request->all());
       
       $q = Layouts::Find($request->id);
       $q->page_title = $request->page_title;
       $q->contact = $request->contact;
       $q->email = $request->email;
       //$q->sort_category = $request->sort_category;
       //$q->sort_type = $request->sort_type;
       $q->save();
        return redirect()->route('admin.report.head.setup.management')->with('success','Setup has been updated successfully!');  
    } 
    
    public function myaccount($email = null){
        if($email == ''){
            guest_session_destroy();
            //dd("email empty, redirect to user registration");
            // https://www.simplyretrofits.com/my-account/
        }else{ 
            //$cExistCheck = Customer::where('email',$email)->count();
           // dd($cExistCheck);
            
                $data = Customer::where('email',$email)->first();
                $row = json_decode($data, true);
                if($row) {
                    
                    $customer_id = $row['id'];
                    $image = $row['avatar_url'];;
                    $name = $row['first_name'];
                    $email = $row['email'];
                    $user_name = $row['username'];
                    $phone = $row['billing']['phone'];
                    $city = $row['billing']['city'];
                      foreach( $row['meta_data'] as $arr ){
                        if($arr['key'] == "b2bking_account_approved"){
                        $acc_approval_status = $arr['value'];
                        }
                      }
                    $account_status_on_wordpress = $acc_approval_status;
                    $fetch_status = 'no';
                     //dd($data,$customer_id,$image,$name,$email,$city,$acc_approval_status);
                     if($acc_approval_status == "yes"){ 
                         // create a session for SR client
                           $guestSession = guest_session_create();
                           return redirect("popular-product-pricelist/canada");
                     }
                   //  popular.product.price.list
                }

                else{
                    guest_session_destroy();
                   
                    //$guestSession = Session::get('GuestSesId');
                    //dd("no exist",$guestSession);
                    
                } 
               
             
            
        }
       /*
        $q0 = DB::connection('mysql2')
            ->table('simp_users')
            ->where('user_email',$email)
            ->count(); // from database  1

        if($q0>0){
            $q1 = DB::connection('mysql2')
            ->table('simp_users')
            ->where('user_email',$email)
            ->first(); // from database  1

            $customer_id = $q1->ID;
           //dd($customer_id);
            // fetch by rest API
            $customer = Customer::find($customer_id);
            dd($customer);
        }
        // from database  2
        /*$q = DB::connection('mysql2')
            ->table('simp_users')
            ->get();
       
        //dd($q0,$q);
       */
        return redirect()->route('denied.access');  
       }
     
       public function deniedAccess(){
        return view('front.404');
       }

}
