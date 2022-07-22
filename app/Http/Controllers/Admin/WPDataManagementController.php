<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Product;
use App\Models\admin\wpData;
use App\Models\admin\wpFetehedData;
use App\Models\admin\notInsertedWpDatas;
use App\Models\admin\WpNonRetrived;
use Carbon\Carbon;
use App\Admin\view_type;
use Image;
use File;
use Codexshaper\WooCommerce\Facades\Customer;
use DB;

class WPDataManagementController extends Controller
{
   public function index(){
        /*//dd("here");
         $products = Product::all();
         dd($products);
         */
        // call iframe 
        $q = wpData::count();
                          
        return view('admin.wpdatamanage.iframe.index',compact('q'));  
   }
   public function fetchedDataFilter(){
      /*
      $q0 = notInsertedWpDatas::get();
      //dd($q0);
      foreach($q0 as $q1){
         $this->saveNonRetrievedDataToWPFetchedDataAfterFetch($q1->wp_id);
      }
      */
      $q = wpFetehedData::get();
      return view('admin.wpdatamanage.fecthedDataFilter',compact('q'));  

   }
   public function fetchedDataFilterSave(Request $request){

      $wp_id = [];

      if($request->wp_id!=''){
         foreach($request->wp_id as $q){
            array_push($wp_id, $q); 
            } 
      }

      $q = wpFetehedData::whereIn('wp_id',$wp_id)->get();
      $this->dataTransferFromWPData($q,"new",0);
      
      //$q = wpFetehedData::truncate();
      return redirect("admin/wp-data/view");
   }

   private function dataTransferFromWPData($data,$insertType,$wp_id){
      //dd("Here",$data,$insertType,$wp_id);
      foreach($data as $q1){ //dd("here",$q1->wp_id);
         if($insertType == "new"){
            $q2 = new wpData();
            $q2->wp_id = $q1->wp_id;
         }else{
            $q2 = wpData::where('wp_id',$wp_id)->first();
         }
        
         $q2->wp_title = $q1->title;
         $q2->title = $q1->title;
         $q2->permalink = $q1->permalink;
         $q2->image = $q1->image;
         $q2->resize_image = '';

         $q2->wp_short_des = $q1->short_des;
         $q2->short_des = $q1->short_des;

         $q2->wp_sku = $q1->sku;
         $q2->sku = $q1->sku;

         $q2->type = $q1->type;

         $q2->wp_variable_product_price = $q1->variable_product_price;
         $q2->variable_product_price = $q1->variable_product_price;

         $q2->wp_regular_price = $q1->regular_price;
         $q2->regular_price = $q1->regular_price;

         $q2->wp_canada_price = $q1->canada_price;
         $q2->canada_price = $q1->canada_price;

         $q2->wp_ontario_price = $q1->ontario_price;
         $q2->ontario_price = $q1->ontario_price;
         $q2->categories = $q1->categories;
         $q2->hubspot_p_description = $q1->hubspot_p_description;

         if($insertType == "new"){
            $q2->view_type = '';
            $q2->view_status = 'no';
            $q2->serial = 0;
            $q2->save_type = 'new';
         }
        
         $q2->save();

         if($insertType == "new"){
            $lastid = $q2->id;
            $q3 = wpData::Find($lastid);
            $q3->serial = $lastid;
            $q3->save();
         }
         
      }
      return "";
   }

   public function dataView(){
      $all = wpData::orderBy('serial')->paginate(30);
      $view_type = view_type::all();
      // $qsimple = wpData::where('type','simple')->paginate();
      //$qvariable = wpData::where('type','variable')->orderBy('variable_product_price','asc')->get();
      //return view('admin.wpdatamanage.data-view',compact('qsimple','qvariable','all'));
      return view('admin.wpdatamanage.data-view',compact('all','view_type'));
   }

   
   public function editInternal($from = null,$to = null){
      if(($from >0) AND ($to > 0)){
         $q = wpData::where('id','>=',$from)
         ->where('id','<=',$to)
         ->get();
      }else
      $q = 'no_data';
      return view('admin.wpdatamanage.editdata',compact('from','to','q'));
   }
   public function viewSelectedData(){
      $edit_from = request()->get('edit_from');
      $edit_to = request()->get('edit_to');

      $q = wpData::where('id','>=',$edit_from)
         ->where('id','<=',$edit_to)
         ->get();
      $option = 'selectedDataView';
      //return view('admin.wpdatamanage.ajax.results',['option'=>'selectedDataView','edit_from'=>$edit_from,'edit_to'=>$edit_to,'q'=>$q ]);
         return view('admin.wpdatamanage.ajax.results',compact('option','q','edit_from','edit_to'));
      //dd($edit_from,$edit_to);
   }

   public function editedDataSave(Request $request){
     
     // dd($request->all());
      $from = $request->from;  $to = $request->to;
      $id = []; $title = []; $des = []; $rp = []; $cp = []; $op = []; $sku = []; $vprice = [];
      $view_type = [];
      //dd($request->all());
      $idQty = $request->id;
      // id retrieve
      if($request->id!=''){
         foreach($request->id as $q){
            array_push($id, $q); 
            } 
      }

      // title retrieve
      if($request->title!=''){
         foreach($request->title as $q){
            array_push($title, $q); 
            } 
      }
      // des retrieve
      if($request->des!=''){
         foreach($request->des as $q){
            array_push($des, $q); 
            } 
      }

        // sku retrieve
        if($request->sku!=''){
         foreach($request->sku as $q){
            array_push($sku, $q); 
            } 
         }

         // rp retrieve
        if($request->rp!=''){
         foreach($request->rp as $q){
            array_push($rp, $q); 
            } 
         }



         // cp retrieve
        if($request->cp!=''){
         foreach($request->cp as $q){
            array_push($cp, $q); 
            } 
         }


         // op retrieve
        if($request->op!=''){
         foreach($request->op as $q){
            array_push($op, $q); 
            } 
         }


      // vprice retrieve
      if($request->vprice!=''){
         foreach($request->vprice as $q){
            array_push($vprice, $q); 
            } 
      }
      /*
       // view_type retrieve
       if($request->view_type!=''){
         foreach($request->view_type as $q){
            array_push($view_type, $q); 
            } 
      }
      */

     //dd($vprice,$request->view_type);
      

      
      for($i=0;$i<count($idQty); $i++){
         //echo $id[$i];
         $q = wpData::Find($id[$i]);
         $q->title = $title[$i];
         $q->sku = $sku[$i];
         $q->short_des = $des[$i];
         $q->regular_price = $rp[$i];
         $q->canada_price = $cp[$i];
         $q->ontario_price = $op[$i];
         if($q->type == "variable")
         $q->variable_product_price = $vprice[$i];
         
          //$q->view_type = $view_type[$i];
         $q->save();

      } 
      return redirect()->back()->withMessage('Product updated successfully!');
      //return redirect()->route('admin.wpdata.manage.edit.internal',['from'=> $from,'to'=>$to])->with('success','Data has been updated successfully!');  
      //dd($id,$title,$sku,$des,$rp,$cp,$op);


   }
   public function wpdatareset($id){
      $q = wpData::Find($id);
      $q->title = $q->wp_title;
      $q->short_des = $q->wp_short_des;
      $q->sku = $q->wp_sku;
      $q->variable_product_price = $q->wp_variable_product_price;
      $q->regular_price = $q->wp_regular_price;
      $q->canada_price = $q->wp_canada_price;
      $q->ontario_price = $q->wp_ontario_price;
      $q->save();
      //dd($q);
      return redirect()->back()->withMessage('Product reset successfull!');
   }

   public function proceedFordownloadAndResizeWpLinkedImages(){

      $donloaded = wpData::where('image','!=','')->where('resize_image','!=','')->count();
      $pending = wpData::where('image','!=','')->where('resize_image','')->count();
      return view('admin.wpdatamanage.resizeAndDownloadProceed',compact('donloaded','pending'));
      
   }

   

   private function cleanDirectory(){
      File::cleanDirectory(public_path('thumbnail'));
      return "";
   }

    

   public function downloadAndResizeWpLinkedImages(Request $request)
   {

      // ini_get('allow_url_fopen') ? 'Enabled' : 'Disabled';
      // ini_get('allow_url_fopen') ? 'Enabled' : 'Disabled';
      // get data where resize link is empty or null
      $qty = $request->qty;
      $links = wpData::where('image','!=','')->where('resize_image','')->orderBy('id')->take($qty)->get();
      //$links = Thumbnail::whereNull('resize_link')->orWhere('resize_link', '')->get();

      // $image->resize(200, 200, function($constraint){
      //     $constraint->aspectRatio();
      // });
      // dd($links);
      $this->singleImageResizeAndDownload($links);
      
      return redirect()->route('admin.wpdata.manage.download.resize');  
   }

   private function singleImageResizeAndDownload($links){
      foreach ($links as $link) {
        
         $path = $link->image;
         // if i get any encoded data in url, decode it
         // dd(urldecode(basename($path)));
         // $path2 = 'http://www.chutyrooms.com/images/'.urlencode(basename($path));
         //$extension = strrchr( $path, '/');
         // dd($path2);
   
         // get client original name
   
         $filename = basename($path);
         // dd($filename);
   
         // get extension
         $extension = strrchr($filename, '.');
         // dd($extension);
   
         // get filename without extension
         $name = str_replace($extension, '', $filename);
         $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
   
   
         $filename = 'thumbnail/' . $name .$link->wp_id.'_'.$link->id. '.' . 'jpg';
   
         $path_to = file_get_contents($path, false, stream_context_create([
               'ssl' => [
                  'verify_peer'      => false,
                  'verify_peer_name' => false,
               ],
         ]));
   
         Image::make($path_to)->resize(200, 100, function ($constraint) {
               $constraint->aspectRatio();
         })->save(public_path($filename));
         $link->resize_image = $filename;
   
   
         $link->save();
      }
      
   }

   public function viewAllData(){
      $all = wpData::orderBy('serial')->get();
      
       return view('admin.wpdatamanage.alldata',compact('all'));
   }

   public function rearrangeData(){
      $all = wpData::where('view_status','yes')->orderBy('serial')->get();
      $view_type = view_type::all();
       return view('admin.wpdatamanage.rearrange',compact('all','view_type'));
   }


   public function check(Request $request){
      //dd($request->all());
      $array = $request->item;
      foreach ($array as $key => $value) {
         # code...
         $test = wpData::find($value);
         $test->serial = $key;
         $test->save();
      }
   }
   public function singleEditView($id){
      $q1 = wpData::Find($id);
      $view_type = view_type::all();
      return view('admin.wpdatamanage.singleEdit',compact('q1','view_type'));
   }

   public function refetchProduct(Request $request){
      
      $product_id = $request->wp_id;
      $product = Product::find($product_id);
                              
      $data = json_encode($product);  
   }

   public function ViewStatusUpdate(){

      $id = request()->get('id');
      $status = request()->get('status');
     // dd("here");
      $q1 = wpData::Find($id);
      $q1->view_status = $status;
      $q1->save();

     
      if(($status == "yes") AND ($q1->image != '') AND ($q1->resize_image == '')){
         $links = wpData::where('id',$id)->get();
         $this->singleImageResizeAndDownload($links);
         $option = "uploadedImgaeShow";
         $q2 = wpData::where('id',$id)->first();
         return view('admin.wpdatamanage.ajax.results',compact('option','q2'));
      }
     
   }

   public function ViewTypeUpdate(){
      $view_type = request()->get('view_type');
      $id = request()->get('id');
    
      $q1 = wpData::Find($id);
      $q1->view_type = $view_type;
      $q1->save();
     
     
   }

   public function refetchProductFromWeb($wp_id){
      //dd($wp_id);
      //$product_id = 22353;

      $q1 = wpData::where('wp_id',$wp_id)->first();
     
      $product = Product::Find($wp_id);
      $data = json_encode($product);  
      $row = json_decode($data, true);
      //dd($product);

      $image = '';
      $wp_id = $row['id'];
      $title = $row['name']; 
      $permalink = $row['permalink'];
      $image = $row['images'][0]['src'];
      if($row['short_description'] != '')
      $short_des = $row['short_description'];
      else
      $short_des = "something";

      $sku = $row['sku'];
      $type = $row['type'];

      if($row['type'] == "variable"){
         $variable_product_price = $row['price_html'];
         $regular_price = 0;
         $canada_price = 0;
         $ontario_price = 0;

      }else{
         $variable_product_price = '';
         $regular_price = $row['regular_price'];
         $canada_price = 0;
         $ontario_price = 0;
         
         foreach( $row['meta_data'] as $arr ){
            
            if($arr['key'] == "b2bking_regular_product_price_group_21363"){
               // $canada_price = $row['meta_data'][6]['value'];
               $canada_price = $arr['value'];
            }

            if($arr['key'] == "b2bking_regular_product_price_group_21362"){
               $ontario_price = $arr['value'];
            }
            
         }
      }
      
      // insert into wpFetehedData
      wpFetehedData::truncate();

      $q3 = new wpFetehedData();
      $q3->wp_id = $wp_id;
      $q3->title = $title;
      $q3->permalink = $permalink;
      $q3->image = $image;
      $q3->short_des = $short_des;
      $q3->sku = $sku;
      $q3->type = $type;
      $q3->variable_product_price = $variable_product_price;
      $q3->regular_price = $regular_price;
      $q3->canada_price = $canada_price;
      $q3->ontario_price = $ontario_price;
      $q3->save();

      if($q3->save()){
         // unlink the image from existing row
         $resize_image = $q1->resize_image;
         if($resize_image != ''){
            $resize_image =  "public/".$resize_image;
            if(file_exists($resize_image)){
               unlink($resize_image);
               echo "exist";
            }
            // else echo "Not exist";
         }
        

         // update 
         $q = wpFetehedData::where('wp_id',$wp_id)->get();
        
         $this->dataTransferFromWPData($q,"old",$wp_id);
         // upload picture 
         $links = wpData::where('id',$q1->id)->get();
         $this->singleImageResizeAndDownload($links);
      }
      //dd("end");
      return redirect()->back()->withMessage('Product updated successfully!');
         // now update row in 
       
       
      
      //$links = wpData::where('image','!=','')->where('resize_image','')->orderBy('id')->take($qty)->get();
      //echo $product['short_description'];
      //
   }
   

   public function NonInsertedDataFetch(){
      //dd("i am here");
      
      $q1 = notInsertedWpDatas::get();
      foreach($q1 as $q2){
         $this->NonInsertedDataSave($q2->wp_id);
      }
      return redirect("admin/wp-data/fetch-preview/filter");
      
   }
   private function NonInsertedDataSave($wp_id){
      
     
      $product = Product::Find($wp_id);
      $data = json_encode($product);  
      $row = json_decode($data, true);
      //dd($product);

      $image = '';
      $wp_id = $row['id'];
      $title = $row['name']; 
      $permalink = $row['permalink'];
      if($row['images'][0] == "")
      $image = '';
      else
      $image = $row['images'][0]['src'];
     
      if($row['short_description'] != '')
      $short_des = $row['short_description'];
      else
      $short_des = "";

      $sku = $row['sku'];
      $type = $row['type'];

      if($row['type'] == "variable"){
         $variable_product_price = $row['price_html'];
         $regular_price = 0;
         $canada_price = 0;
         $ontario_price = 0;

      }else{
         $variable_product_price = '';
         $regular_price = $row['regular_price'];
         $canada_price = 0;
         $ontario_price = 0;
         
         foreach( $row['meta_data'] as $arr ){
            
            if($arr['key'] == "b2bking_regular_product_price_group_21363"){
               // $canada_price = $row['meta_data'][6]['value'];
               $canada_price = $arr['value'];
            }

            if($arr['key'] == "b2bking_regular_product_price_group_21362"){
               $ontario_price = $arr['value'];
            }
            
         }
      }
      
      // insert into wpFetehedData
     

      $q3 = new wpFetehedData();
      $q3->wp_id = $wp_id;
      $q3->title = $title;
      $q3->permalink = $permalink;
      $q3->image = $image;
      $q3->short_des = $short_des;
      $q3->sku = $sku;
      $q3->type = $type;
      $q3->variable_product_price = $variable_product_price;
      $q3->regular_price = $regular_price;
      $q3->canada_price = $canada_price;
      $q3->ontario_price = $ontario_price;
      $q3->save();
      return ""; 
   }
   
   public function nonRetrivedData(){
      $q = notInsertedWpDatas::count();
      $q2 =  notInsertedWpDatas::get();            
      return view('admin.wpdatamanage.non_retrived_data',compact('q','q2'));  
   }

   public function fetchNonRetrievedDataBulksave(Request $request){

      //dd($request->wp_id);
      $wp_id = [];

      if($request->wp_id!=''){
         foreach($request->wp_id as $q){
            array_push($wp_id, $q); 
            } 
      }
      $count = count($request->wp_id);
      //dd($count);
      for($i=0;$i<count($request->wp_id); $i++){
         $this->fetchNonRetrievedData($wp_id[$i],"multiple");
      }
       
 
      return redirect()->back()->withMessage('Product fetched successfully!');
   }

   public function fetchNonRetrievedData($wp_id,$saveType){
     
      //dd($wp_id,$saveType);
      $q1 = WpNonRetrived::where('wp_id',$wp_id)->count();
      if($q1 == 0){ // if does not exist
         $product = Product::Find($wp_id);
         $data = json_encode($product);  
         $row = json_decode($data, true);
         //dd($product);

         $image = '';
         $wp_id = $row['id'];
         $title = $row['name']; 
         $permalink = $row['permalink'];
         $image = $row['images'][0]['src'];
         if($row['short_description'] != '')
         $short_des = $row['short_description'];
         else
         $short_des = "something";

         $sku = $row['sku'];
         $type = $row['type'];

         if($row['type'] == "variable"){
            $variable_product_price = $row['price_html'];
            $regular_price = 0;
            $canada_price = 0;
            $ontario_price = 0;

         }else{
            $variable_product_price = '';
            $regular_price = $row['regular_price'];
            $canada_price = 0;
            $ontario_price = 0;
            
            foreach( $row['meta_data'] as $arr ){
               
               if($arr['key'] == "b2bking_regular_product_price_group_21363"){
                  // $canada_price = $row['meta_data'][6]['value'];
                  $canada_price = $arr['value'];
               }

               if($arr['key'] == "b2bking_regular_product_price_group_21362"){
                  $ontario_price = $arr['value'];
               }
               
            }
         }
         
         // insert into wpFetehedData
         //wpFetehedData::truncate();

         $q3 = new WpNonRetrived();
         $q3->wp_id = $wp_id;
         $q3->title = $title;
         $q3->permalink = $permalink;
         $q3->image = $image;
         $q3->short_des = $short_des;
         $q3->sku = $sku;
         $q3->type = $type;
         $q3->variable_product_price = $variable_product_price;
         $q3->regular_price = $regular_price;
         $q3->canada_price = $canada_price;
         $q3->ontario_price = $ontario_price;
         $q3->save();

         
         $q3 = new wpFetehedData();
         $q3->wp_id = $wp_id;
         $q3->title = $title;
         $q3->permalink = $permalink;
         $q3->image = $image;
         $q3->short_des = $short_des;
         $q3->sku = $sku;
         $q3->type = $type;
         $q3->variable_product_price = $variable_product_price;
         $q3->regular_price = $regular_price;
         $q3->canada_price = $canada_price;
         $q3->ontario_price = $ontario_price;
         $q3->save();



         if($saveType == "single")
         return redirect()->back()->withMessage('Product fetched successfully!');
         else
         return "";
     }
     else
     {
      if($saveType == "single")
      return redirect()->back()->withMessage('Already fetched!');
      
     }
      
     
   }


   public function saveNonRetrievedDataToWPFetchedDataAfterFetch($wp_id){
     
      //dd($wp_id,$saveType);
    
     
         $product = Product::Find($wp_id);
         $data = json_encode($product);  
         $row = json_decode($data, true);
         //dd($product);

         $image = '';
         $wp_id = $row['id'];
         $title = $row['name']; 
         $permalink = $row['permalink'];
         $image = $row['images'][0]['src'];
         if($row['short_description'] != '')
         $short_des = $row['short_description'];
         else
         $short_des = "something";

         $sku = $row['sku'];
         $type = $row['type'];

         if($row['type'] == "variable"){
            $variable_product_price = $row['price_html'];
            $regular_price = 0;
            $canada_price = 0;
            $ontario_price = 0;

         }else{
            $variable_product_price = '';
            $regular_price = $row['regular_price'];
            $canada_price = 0;
            $ontario_price = 0;
            
            foreach( $row['meta_data'] as $arr ){
               
               if($arr['key'] == "b2bking_regular_product_price_group_21363"){
                  // $canada_price = $row['meta_data'][6]['value'];
                  $canada_price = $arr['value'];
               }

               if($arr['key'] == "b2bking_regular_product_price_group_21362"){
                  $ontario_price = $arr['value'];
               }
               
            }
       
         $q3 = new wpFetehedData();
         $q3->wp_id = $wp_id;
         $q3->title = $title;
         $q3->permalink = $permalink;
         $q3->image = $image;
         $q3->short_des = $short_des;
         $q3->sku = $sku;
         $q3->type = $type;
         $q3->variable_product_price = $variable_product_price;
         $q3->regular_price = $regular_price;
         $q3->canada_price = $canada_price;
         $q3->ontario_price = $ontario_price;
         $q3->save();
         return "";
     }
     
     
   }

   public function connectionCheck(){

      $q0 = DB::table('users')->get(); // from database  1

      // from database  2
      $q = DB::connection('mysql2')
          ->table('simp_users')
         ->get();

      dd($q0,$q);

  }



}
