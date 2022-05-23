<?php
// https://codexshaper.github.io/docs/laravel-woocommerce/
//https://docs.cocart.xyz/#introduction-requirements
//https://cocart.xyz/?utm_medium=wp.org&utm_source=wordpressorg&utm_campaign=readme&utm_content=cocart
// https://stackoverflow.com/questions/31847054/how-to-use-multiple-databases-in-laravel
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// command
/*
INSERT INTO  `wp_fetehed_data_2`
(
SELECT NULL,`wp_id`,`title`,`permalink`,`image`,`short_des`,`sku`,`type`,`variable_product_price`,`regular_price`,`canada_price`,`ontario_price`,`created_at`,`updated_at`
FROM  `wp_fetehed_data`
)
*/
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
 
    return "<h1> Cleared!</h1>";
 });
 
Route::get('generate-pdf','Admin\PDFController@generatePDF');
//Route::get('report-pdf/{type}','Admin\ReportsController@downloadpdf')->name('pr-pdf-download');
Route::get('report-pdf/{type}',array('as'=>'pdfview','uses'=>'Admin\ReportsController@downloadpdf'));

Route::get('pdf-view/{type}','Admin\ReportsController@generatePDFView');

Route::get('sendIframeEmail','Admin\CustomerMangement@sendIframeEmail')->name('iframe.email');


Route::get('conection/check', 'Admin\WPDataManagementController@connectionCheck');
Route::get('authenticate/{email?}', 'Admin\ReportsController@myaccount');
//Route::get('/list-show/{type?}','ReportsController\ReportsController@list')->name('list-show');
Route::get('popular-product-pricelist/{type?}','Admin\ReportsController@list')->name('popular.product.price.list');

Route::get('denied/access','Admin\ReportsController@deniedAccess')->name('denied.access');


Route::get('/', function () {
    return view('landing-page');
});

//Route::get('/popular-product-pricelist/{type?}','Admin\ReportsController@list')->name('popular.product.price.list');

Auth::routes(['verify'=>true]);

// user opt verify after registration
Route::get('/registration-otp-verify','Auth\RegisterController@registrationOtpVerify')->name('user.registration.otp.verify');
Route::post('/registration-otp-submit','Auth\RegisterController@registrationOtpSubmit')->name('user.registration.otp.submit');
Route::get('/registration-otp-reverify','Auth\RegisterController@registrationOtpReVerify')->name('user.registration.otp.reverify');
Route::get('/contact/admin','Auth\UserPhoneActivationController@contactAdmin')->name('contact.admin');
Route::get('/registration-otp-request','Auth\RegisterController@registrationOtpReRequest')->name('user.registration.otp.request');


// registration ajax
Route::get('/client/notitypeEmail', 'Auth\LoginController@clientNotiTypeEmail')->name('client.notitype.email');
Route::get('/client/notiTypePhone', 'Auth\LoginController@clientNotiTypePhone')->name('client.notitype.phone');

Route::get('/client/unamecheck', 'Auth\LoginController@unameCheck')->name('client.uname.check');

  // client notification email activation
  Route::get('activation/check/{email}','Auth\ClientNotificationEmailActivationController@activationCheck')->name('client.email.activation.check'); 
  Route::post('activation-link/resend', 'Auth\ClientNotificationEmailActivationController@resendactivationlink')->name('client.email.activationlink.resend'); 
  Route::get('/account/activate/{email}/{token}', 'Auth\ClientNotificationEmailActivationController@accountactivate')->name('client.account.activate'); 

  // set password first time
  Route::get('customer/password/create', 'Client\SettingsController@showPasswordCreateForm')->name('customer.password.create');
  Route::post('customer/password/create', 'Client\SettingsController@createPasswordSave')->name('customer.password.create.save');


// client auth route 
Route::middleware(['auth:web'])->group(function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/user/logout','Auth\LoginController@userLogout')->name('uesr.logout');

     // client settings   
    Route::get('/settings/accounts','Client\SettingsController@accountsProperty')->name('client.settings.accounts');
    Route::post('/settings/change-password','Client\SettingsController@changePassword')->name('client.settings.password.update');
    Route::get('/settings/account-info/update','Client\SettingsController@accountInfoUpdate')->name('client.settings.accountinfo.update');
    Route::post('/settings/account-info/update','Client\SettingsController@accountInfoUpdateSave')->name('client.settings.accountinfo.update.save');
    // send gen info for publishment
    

    Route::get('/client/info-update/notitypeEmail', 'Client\SettingsController@clientNotiTypeEmail')->name('client.info-update.notitype.email');
    Route::get('/client/info-update/notitypePhone', 'Client\SettingsController@clientNotiTypePhone')->name('client.info-update.notitype.phone');
    
    

    Route::post('/settings/account-info/update/send','Client\SettingsController@accountInfoSendForPublishment')->name('client.settings.accountinfo.update.send');

    

     // payments
     Route::get('clients/payments','Client\PaymentsController@addPayments')->name('client.payments.add');
     Route::post('clients/payments','Client\PaymentsController@paymentsSave')->name('client.payments.save');
     Route::get('clients/payments/draft/sent','Client\PaymentsController@draftSentList')->name('client.payments.list.draftsent');
     Route::get('clients/payments/approved','Client\PaymentsController@approvedList')->name('client.payments.list.approved');

     Route::get('client/payments/edit/{id}', 'Client\PaymentsController@paymentEdit')->name('client.payments.edit');
     Route::post('client/payments/edit', 'Client\PaymentsController@paymentEditSave')->name('client.payments.edit.save');

     Route::get('client/payments/delete/{id}', 'Client\PaymentsController@paymentDelete')->name('client.payments.delete');

     // send to admin for publishment
     Route::get('clients/payments/draft/send/for/publishment/{id}','Client\PaymentsController@draftSendForPublishMent')->name('client.draft.payment.send.for.publishment');
    
     // balance sheet
     Route::get('clients/payments/balanace-sheet','Client\PaymentsController@balanceSheet')->name('client.payments.balance_sheet');
    // balance ajax
    Route::get('client/yearwise/payments','Client\PaymentsController@yearWisePayments')->name('client.yearwise.payemnts.ajax');
    Route::get('client/yearwise/monthwise/payments','Client\PaymentsController@yearMonthWisePayments')->name('client.yearwise.monthwise.payemnts.ajax');

    
     

});

 


Route::prefix('admin')->group(function(){

    Route::get('/login','Auth\AdminLoginController@ShowLoginForm')->name('admin.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit'); 

    Route::middleware(['auth:admin'])->group(function(){
        Route::get('/', 'AdminController@index')->name('admin.dashboard');
        Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');

        // client management from admin
      
        Route::get('clients/list/approved','Common\ClientsController@approveClientListFromAdmin')->name('admin.clients.list.approved');
        Route::get('clients/list/pending','Common\ClientsController@pendingClientListFromAdmin')->name('admin.clients.list.pending');
    
        // payments management from admin 
        Route::get('clients/payments/approved','Common\PaymentsController@approvePaymentsListFromAdmin')->name('admin.payments.management.approved');
        Route::get('clients/payments/pending','Common\PaymentsController@pendingPaymentsListFromAdmin')->name('admin.payments.management.pending');
        Route::get('clients/payments/balance-sheet','Common\PaymentsController@balanaceSheetCheckFromAdmin')->name('admin.payments.management.balanace-sheet');

        
       // apartments
       /*
       Route::get('apartment/management','Admin\ApartmentController@index')->name('admin.apartment.management');
       Route::post('/apartment/add/save','Admin\ApartmentController@apartmentNameAddSave')->name('admin.apartment.management.add.save');
       Route::get('/apartment/edit/{id}','Admin\ApartmentController@Edit')->name('admin.apartment.management.edit');
       Route::post('/apartment/edit','Admin\ApartmentController@editsave')->name('admin.apartment.management.edit.save');
       
       // moderator managemnet 
       Route::get('moderator/pendinglist','Admin\ModeratorManagementController@pending')->name('admin.moderators.head.user.pending');
       Route::get('moderator/approvelist','Admin\ModeratorManagementController@approved')->name('admin.moderators.head.user.approved');

       Route::get('moderator/approve/{id}','Admin\ModeratorManagementController@approvedModerator')->name('admin.moderators.head.approve.single.moderator');
       Route::get('moderator/block/{id}','Admin\ModeratorManagementController@blockModerator')->name('admin.moderators.head.block.single.moderator');
       Route::get('moderator/unblock/{id}','Admin\ModeratorManagementController@unBlockModerator')->name('admin.moderators.head.unblock.single.moderator');
      
       // moderator update 
       Route::get('moderator/geningo/update/pending','Admin\ModeratorManagementController@updatePending')->name('admin.moderators.head.update.pending');
       Route::get('moderator/geningo/approve/{id}','Admin\ModeratorManagementController@approvedGenInfoModerator')->name('moderators.geninfo.update.approve');
       Route::get('moderator/geningo/decline/{id}','Admin\ModeratorManagementController@declineGenInfoModerator')->name('moderators.geninfo.update.decline');

       // geninfo management

       Route::get('clients/genifo-update/pending/list','Common\ClientsController@pendingGenInfoListromAdmin')->name('admin.clients.list.geninfo.pending');
        */
       // simply retrofits route starts 
       // non inserted data fetch again
       Route::get('wp-data/non-inserted-data-fetch','Admin\WPDataManagementController@NonInsertedDataFetch')->name('admin.noninserted.data.fetch');  

        //  data fetch from wordpress website
        Route::get('wp-data/fetch-preview','Admin\WPDataManagementController@index')->name('admin.wpdata.manage.fetch');  
        Route::get('wp-data/fetch-preview/filter','Admin\WPDataManagementController@fetchedDataFilter')->name('admin.wpdata.manage.fetched.filter');  
        Route::post('wp-data/fetch-preview/filter','Admin\WPDataManagementController@fetchedDataFilterSave')->name('admin.wpdata.manage.fetched.filter.save');  
       
        Route::get('wp-data/rearrange','Admin\WPDataManagementController@rearrangeData')->name('admin.report.head.rearrange');  

        
        // download and resize image from wp image link
        Route::get('proceed/download/resize','Admin\WPDataManagementController@proceedFordownloadAndResizeWpLinkedImages')->name('admin.wpdata.manage.download.resize');  
        Route::post('proceed/download/resize','Admin\WPDataManagementController@downloadAndResizeWpLinkedImages')->name('admin.wpdata.manage.download.resize.action');  
        
        // non fetched data
        Route::get('wp-data/non-fetched','Admin\WPDataManagementController@nonRetrivedData')->name('admin.wpdata.manage.nonretrieved');  
        // REFETCH NON RETRIVED DATA
        Route::get('wp-data/non-retrieved/data-fetch/{wp_id}/{fetch_type}','Admin\WPDataManagementController@fetchNonRetrievedData')->name('admin.wpdata.manage.nonretrieved.data.refetch');  
        Route::post('wp-data/non-retrieved/data-fetch','Admin\WPDataManagementController@fetchNonRetrievedDataBulksave')->name('admin.wpdata.manage.nonretrieved.data.refetch.multiple');  

        

        // view data
        Route::get('wp-data/view','Admin\WPDataManagementController@dataView')->name('admin.wpdata.manage.view');  
        Route::get('wp-data/edit/{from?}/{to?}','Admin\WPDataManagementController@editInternal')->name('admin.wpdata.manage.edit.internal');  
        Route::post('/wp-data/edit/save','Admin\WPDataManagementController@editedDataSave')->name('admin.wpdata.edit.save');  
        Route::get('wp-data/reset/{id}','Admin\WPDataManagementController@wpdatareset')->name('admin.wpdata.manage.reset');  
        Route::get('wp-data/single-edit/{id}','Admin\WPDataManagementController@singleEditView')->name('admin.wpdata.manage.single.edit');  
        Route::post('wp-data/refetch','Admin\WPDataManagementController@refetchProduct')->name('admin.wpdata.manage.refetch');  

        Route::get('wp-data/refetch-from-web/{wp_id}','Admin\WPDataManagementController@refetchProductFromWeb')->name('admin.wpdata.manage.refetch.from.web');  


        // ajax
        Route::get('wp-data/ajax/view-selected-rows','Admin\WPDataManagementController@viewSelectedData')->name('admin.wpdata.ajax.view.selected.data');  
        Route::get('view-all-data', 'Admin\WPDataManagementController@viewAllData')->name('view.all.data');
        Route::get('check', 'Admin\WPDataManagementController@check')->name('check');

        Route::get('wp-data/ajax/ViewStatusUpdate','Admin\WPDataManagementController@ViewStatusUpdate'); 
        Route::get('wp-data/ajax/ViewTypeUpdate','Admin\WPDataManagementController@ViewTypeUpdate');  
        

        // reports management
        Route::get('reports/canada','Admin\ReportsController@canadaReportCreate')->name('admin.report.head.list.canada');  
        Route::get('reports/ontario','Admin\ReportsController@ontarioReportCreate')->name('admin.report.head.list.ontario');  
        Route::post('reports/save','Admin\ReportsController@rerortSave')->name('admin.report.head.list.save');  
         
        // list head create
        Route::get('/setup/management','Admin\ReportsController@setupManagement')->name('admin.report.head.setup.management');  
        Route::post('/setup/management','Admin\ReportsController@setupManagementSave')->name('admin.report.head.setup.management.save');  

         // ajax
         Route::get('/reports/setup/ajax/category','Admin\ReportsController@setupCategory')->name('admin.setup.category');  
       

         // customers management
         Route::get('fetch-customer-info','Admin\CustomerMangement@index')->name('admin.customer.management.fetch');  
         Route::get('fetched-customer-preview','Admin\CustomerMangement@fetchedPreview')->name('admin.customer.management.fetch.preview');  
         Route::post('fetched-customer-preview-selection','Admin\CustomerMangement@fetchedPreviewSelectionSave')->name('admin.customer.management.fetch.selection.save');  
         Route::get('sr/customers','Admin\CustomerMangement@srCustomers')->name('admin.customer.management.operation');  

        // account create by admin by ajax
        Route::get('user_account_create/send_email','Admin\CustomerMangement@userAccountCreationAndSendEmail')->name('user.account.create.and.send.email');

        Route::get('/No/Access', function () {
            return view('admin.404.noPermission');
         })->name('admin.no.pagePermission');

         // products 
         // craete product
         Route::get('product/create','Admin\ProductsController@create')->name('admin.product.management.create');  
         // product save 
         Route::post('product/save','Admin\ProductsController@save')->name('admin.product.management.save');  
         // product type wise price entry field 
        // Route::get('product/save','Admin\ProductsController@save')->name('admin.product.management.save');  
        Route::get('product/list','Admin\ProductsController@list')->name('admin.product.management.list'); 
        //product update  
        Route::get('product/update/{id}','Admin\ProductsController@update')->name('admin.product.management.update');  
         //product updsaveate  
        Route::post('product/update','Admin\ProductsController@updateSave')->name('admin.product.management.updateSave');  
        // delete product 
        Route::get('product/delete/{id}','Admin\ProductsController@delete')->name('admin.product.management.delete');  
        // product details 
        Route::get('product/details/{id}','Admin\ProductsController@details')->name('admin.product.management.details');  

         
    });
    
});


Route::prefix('moderator')->group(function(){

    // moderator activation
    Route::get('activation/check/{email}','Auth\ModeratorEmailActivationController@activationCheck')->name('moderator.email.activation.check'); 
    Route::post('activation-link/resend', 'Auth\ModeratorEmailActivationController@resendactivationlink')->name('moderator.email.activationlink.resend'); 
    Route::get('/account/activate/{email}/{token}', 'Auth\ModeratorEmailActivationController@accountactivate')->name('moderator.account.activate'); 
 
    Route::get('/register', 'Auth\ModeratorRegisterController@ShowRegistrationForm')->name('moderator.register');
    Route::post('/register','Auth\ModeratorRegisterController@register')->name('moderator.register.save');
   

    // moderator registration ajax
    Route::get('/notitypeEmail', 'Auth\ModeratorRegisterController@moderatorNotiTypeEmail')->name('moderator.notitype.email');
    Route::get('/notiTypePhone', 'Auth\ModeratorRegisterController@moderatorNotiTypePhone')->name('moderator.notitype.phone');


    // moderator opt verify after registration
    Route::get('/registration-otp-verify','Auth\ModeratorPhoneActivationController@registrationOtpVerify')->name('moderator.registration.otp.verify');
    Route::post('/registration-otp-submit','Auth\ModeratorPhoneActivationController@registrationOtpSubmit')->name('moderator.registration.otp.submit');
    Route::get('/registration-otp-reverify','Auth\ModeratorPhoneActivationController@registrationOtpReVerify')->name('moderator.registration.otp.reverify');
   // Route::get('/contact/admin','Auth\ModeratorPhoneActivationController@contactAdmin')->name('moderator.contact.admin');
    Route::get('/registration-otp-request','Auth\ModeratorPhoneActivationController@registrationOtpReRequest')->name('moderator.registration.otp.request');


     
    Route::middleware(['auth:moderator'])->group(function(){

        Route::get('/', 'ModeratorController@index')->name('moderator.dashboard');
        //settings
        Route::get('/settings/accounts','Moderator\SettingsController@accountsProperty')->name('moderator.settings.accounts.property');
        Route::post('/settings/change-password','Moderator\SettingsController@changePassword')->name('moderator.settings.password.update');
        Route::get('/settings/account-info/update','Moderator\SettingsController@accountInfoUpdate')->name('moderator.settings.accountinfo.update');
        Route::post('/settings/account-info/update','Moderator\SettingsController@accountInfoUpdateSave')->name('moderator.settings.accountinfo.update.save');
        // send gen info for publishment
        
        Route::post('/settings/account-info/update/send','Moderator\SettingsController@accountInfoSendForPublishment')->name('moderator.settings.accountinfo.update.send');
        
        // client management from moderator
      
        Route::get('clients/list/approved','Common\ClientsController@approveClientListFromModerator')->name('moderator.clients.list.approved');
        Route::get('clients/list/pending','Common\ClientsController@pendingClientListFromModerator')->name('moderator.clients.list.pending');

        // payments management from moderator
            
        Route::get('clients/payments/approved','Common\PaymentsController@approvePaymentsListFromModerator')->name('moderator.payments.management.approved');
        Route::get('clients/payments/pending','Common\PaymentsController@pendingPaymentsListFromModerator')->name('moderator.payments.management.pending');
        Route::get('clients/payments/balanace-sheet','Common\PaymentsController@balanaceSheetCheckFromModerator')->name('moderator.payments.management.balanace-sheet');

        
        // gen info from moderator
        Route::get('clients/gen-info/pending','Common\ClientsController@pendingGenInfoListromModerator')->name('moderator.clients.list.pending.geninfo');
      
    });
    
  
    
    Route::get('/login','Auth\ModeratorLoginController@ShowLoginForm')->name('moderator.login');
    Route::post('/login','Auth\ModeratorLoginController@login')->name('moderator.login.submit'); 
    Route::get('/logout','Auth\ModeratorLoginController@logout')->name('moderator.logout');
});

 
 
// common route
Route::middleware(['auth:admin,moderator'])->group(function(){
 
    Route::get('/approved/clients/{user}', 'Common\ClientsController@approvedClients')->name('approved.clients'); 
    Route::get('/approval-pending/clients/{user}', 'Common\ClientsController@approvalPendingClients')->name('approved.pending.clients'); 
    Route::post('/approval-pending/clients', 'Common\ClientsController@pendingClientApprove')->name('pending.clients.approve'); 

    // approve awaiting client
    Route::get('/approve/pending/clients/{clientId}/{updatedUser}/{updatedUserRole}', 'Common\ClientsController@approveClientStatus')->name('approved.pending.clients.from.pending.to.approve'); 
    Route::get('/decline/pending/clients/{clientId}/{updatedUser}/{updatedUserRole}', 'Common\ClientsController@declineClientStatus')->name('decline.pending.clients.from.pending.to.decline'); 


    // for payments
    Route::get('/iframe/child/approved/paymentslist/{user}', 'Common\PaymentsController@approvedPaymentsIframeChild')->name('iframe.approved.payments.list'); 
    Route::get('/iframe/child/pending/paymentslist/{user}', 'Common\PaymentsController@pendingPaymentsIframeChild')->name('iframe.pending..payments.list'); 
    
    Route::get('/iframe/child/balanace-sheet/{user}', 'Common\PaymentsController@balanaceSheetIframeChild')->name('iframe.child.balance.sheet'); 


    Route::get('/iframe/child/approved/singlePayment/{id}/{uid}/{urole}', 'Common\PaymentsController@iFrameSinglePaymentUpdate')->name('iframe.pending..payments.update'); 
    Route::post('/iframe/child/approved/singlePayment', 'Common\PaymentsController@iFrameSinglePaymentUpdateSave')->name('iframe.pending..payments.update.save'); 


     //Route::get('/iframe/child/approved/singlePayment/{id}/{uid}/{urole}', 'Common\PaymentsController@iFrameSinglePaymentApprove')->name('iframe.pending..payments.approve'); 

    // balance ajax
    Route::get('yearwise/payments','Common\PaymentsController@yearWisePayments')->name('yearwise.payemnts.ajax');
    Route::get('yearwise/monthwise/payments','Common\PaymentsController@yearMonthWisePayments')->name('yearwise.monthwise.payemnts.ajax');

    
    // clients geninfo update management
    Route::get('/iframe/child/geninfo/{user}', 'Common\ClientsController@pendingGenInfoIframeChild')->name('iframe.child.pending.geninfo'); 
    Route::get('/iframe/approve/clients/geninfo/{id}/{role}/{uid}', 'Common\ClientsController@approvedGenInfoOfClient')->name('clients.geninfo.update.approve'); 
    Route::get('/iframe/reject/clients/geninfo/{id}/{role}/{uid}', 'Common\ClientsController@rejectGenInfoOfClient')->name('clients.geninfo.update.reject'); 



 });

 // common route for all
 Route::get('/payment/details/ajax', 'Client\PaymentsController@paymentDeatilsShow')->name('payment.details.modal.show'); 
 Route::get('/client/details/ajax', 'Common\ClientsController@clientDeatilsShow')->name('client.details.modal.show'); 

 Route::get('/moderator/details/ajax', 'Admin\ModeratorManagementController@moderatorDeatilsShow')->name('moderator.details.modal.show'); 


 // route to return from iframe to main after client update
 Route::get('/retrun-admin-client-approval-list',function()
 {
    //dd("$routeName");
 echo "<script>window.top.location.href = 'admin/clients/list/approved'</script>";
 
 })->name('return.to.admin.clients.approval.list');

 
 Route::get('/retrun-moderator-client-approval-list',function()
 {
 echo "<script>window.top.location.href = 'moderator/clients/list/approved'</script>";
 
 })->name('return.to.moderator.clients.approval.list');


 //******************route to return from iframe to main after payment update
 Route::get('/retrun-admin-client-payment-approval-list',function()
 {
    //dd("$routeName");
 echo "<script>window.top.location.href = 'admin/clients/payments/pending'</script>";
 
 })->name('return.to.admin.clients.payment.pending.list');

 
 Route::get('/retrun-moderator-client-payment-approval-list',function()
 {
 echo "<script>window.top.location.href = 'moderator/clients/payments/pending'</script>";
 
 })->name('return.to.moderator.clients.payment.pending.list');





// common route admin and web
Route::middleware(['auth:web,admin'])->group(function () {

    
   //Route::get('/popular-product-pricelist/{type?}','Admin\ReportsController@list')->name('popular.product.price.list.after.login');

 });