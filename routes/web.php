<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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

Route::get('/', function () {
    return redirect()->to('/home');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::group(['prefix' => 'admin'], function () {
//     Voyager::routes();
// });
// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });


// -------------------------


// Route::get('/', function () {
//     return redirect()->to('/admin');
// });

Auth::routes();

Route::get('/run', 'MainController@index');
// Route::get('/home', 'HomeController@index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'front_index'])->name('home.front');

Route::get('/dashboard', function () {
    return view('dashboard');
});

// admin routes
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::resource('city','\App\Http\Controllers\CityController');
   
    Route::resource('unit', '\App\Http\Controllers\UnitController',['except'=>['update']]);
    Route::post('unitUpdate/{id}', '\App\Http\Controllers\UnitController@update');

    Route::resource('region', '\App\Http\Controllers\RegionController',['except'=>['update']]);
    Route::post('regionUpdate/{id}', '\App\Http\Controllers\RegionController@update');

    Route::resource('type', '\App\Http\Controllers\TypeController',['except'=>['update']]);
    Route::post('typeUpdate/{id}', '\App\Http\Controllers\TypeController@update');


    Route::resource('city', '\App\Http\Controllers\CityController',['except'=>['update']]);
    Route::post('cityUpdate/{id}', '\App\Http\Controllers\CityController@update');


    Route::resource('category', '\App\Http\Controllers\CategoryController',['except'=>['update']]);
    Route::post('categoryUpdate/{id}', '\App\Http\Controllers\CategoryController@update');


    Route::resource('galary', '\App\Http\Controllers\GalaryController',['except'=>['update']]);
    Route::post('galaryUpdate/{id}', '\App\Http\Controllers\GalaryController@update');
    Route::post('galary/{id}/display', '\App\Http\Controllers\GalaryController@display');
    Route::post('galary/{id}/no-display', '\App\Http\Controllers\GalaryController@noDisplay');

    Route::resource('offer', '\App\Http\Controllers\OfferController',['except'=>['update']]);

    
    Route::post('offerUpdate/{id}', '\App\Http\Controllers\OfferController@update');

    Route::post('offer/{id}/notify', '\App\Http\Controllers\OfferController@notify');
    Route::post('offer/{id}/no-notify', '\App\Http\Controllers\OfferController@noNotify');


    Route::get('merchant/{id}/activate', '\App\Http\Controllers\MerchantController@activate');
    Route::get('merchant/{id}/de-activate', '\App\Http\Controllers\MerchantController@deActivate');
    Route::resource('merchant', '\App\Http\Controllers\MerchantController',['except'=>['update']]);
    Route::post('merchantUpdate/{id}', '\App\Http\Controllers\MerchantController@update');
    Route::get('showItems/{id}', '\App\Http\Controllers\MerchantController@showItems');
    Route::post('changePassword', '\App\Http\Controllers\MerchantController@changePassword');

    

    Route::resource('item', '\App\Http\Controllers\ItemController',['except'=>['destroy','update','edit','create']]);
    Route::post('item/delete/{id}', '\App\Http\Controllers\ItemController@destroy');
    Route::get('item/edit/{id}', '\App\Http\Controllers\ItemController@edit');
    Route::get('item/create/{id}', '\App\Http\Controllers\ItemController@create');
    Route::post('item/update/{id}', '\App\Http\Controllers\ItemController@update');




    Route::resource('order', '\App\Http\Controllers\OrderController', ['except' => ['update']]);
    Route::post('update-order/{order_id}', '\App\Http\Controllers\OrderController@update');

    Route::post('addRunner', '\App\Http\Controllers\OrderController@addRunner')->name('admin.addRunner');
    Route::get('assignRunner/{order_id}', '\App\Http\Controllers\OrderController@assignRunner');
    Route::get('getRegions/{city_id}', '\App\Http\Controllers\MerchantController@getRegions');

    Route::get('getCategories/{type_id}', '\App\Http\Controllers\MerchantController@getCategories');//get categories according to type of merchant

    Route::post('acceptDeliverOrder', '\App\Http\Controllers\OrderController@acceptDeliverOrder')->name('admin.acceptDeliverOrder');


    Route::resource('transaction', '\App\Http\Controllers\TransactionController');
    //    Route::resource('page','PageController');
    Route::resource('payment-method', '\App\Http\Controllers\PaymentMethodController');
    Route::resource('delivery-method', '\App\Http\Controllers\DeliveryMethodController');
    Route::resource('contact', '\App\Http\Controllers\ContactController');

    Route::resource('client', '\App\Http\Controllers\ClientController',['except'=>['update']]);
    Route::post('clientUpdate/{id}', '\App\Http\Controllers\ClientController@update');

    Route::resource('runner', '\App\Http\Controllers\RunnerController');


    Route::get('settings', '\App\Http\Controllers\SettingsController@view');
    Route::post('updateSettings', '\App\Http\Controllers\SettingsController@update');

    // user reset
    Route::get('user/change-password', '\App\Http\Controllers\UserController@changePassword');
    Route::post('user/change-password', '\App\Http\Controllers\UserController@changePasswordSave');
    //    Route::resource('user','UserController');
       Route::resource('role','\App\Http\Controllers\RoleController');
       Route::resource('notification','\App\Http\Controllers\NotificationController');

    Route::get('items_merchant/{id}', '\App\Http\Controllers\OfferController@items_merchant');
});

Route::group(['prefix' => 'merchant'], function () {
    Route::group(['middleware' => 'auth:merchant_web'], function () {


    Route::get('/', function () {
        return redirect()->to('merchant/dashboard');
    })->name('merchant.dashboard');

    Route::get('/dashboard', 'merchant\HomeController@index');


    Route::resource('item', 'merchant\ItemController',['except'=>['destroy','update','edit','show']]);

    Route::any('item/delete/{id}', 'merchant\ItemController@destroy');
    Route::get('item/edit/{id}', 'merchant\ItemController@edit');
    Route::get('item/show/{id}', 'merchant\ItemController@show');

    Route::post('item/update/{id}', 'merchant\ItemController@update');


    Route::resource('offer', 'merchant\OfferController',['except'=>['update']]);

    Route::post('offerUpdate/{id}', 'merchant\OfferController@update');
  
    Route::get('items_merchant/{id}', 'merchant\OfferController@items_merchant');

    Route::resource('report', 'merchant\ReportController');
    

    Route::resource('order', 'merchant\OrderController', ['except' => ['update']]);
    
    Route::post('update-order/{order_id}', 'merchant\OrderController@update');
    Route::get('getRegions/{city_id}', 'merchant\MerchantController@getRegions');
    Route::get('filter', 'merchant\OrderController@filter');
    Route::get('filterCompletedOrders', 'merchant\OrderController@filterCompletedOrders');

    
    Route::get('acceptedOrders', 'merchant\OrderController@acceptedOrders');

    Route::get('completeOrders', 'merchant\OrderController@completeOrders');
    Route::get('rejectedOrders', 'merchant\OrderController@rejectedOrders');
    Route::get('printInvoice/{id}', 'merchant\OrderController@printInvoice');


    

    Route::post('acceptItem/{id}', 'merchant\OrderController@acceptItem');
    Route::post('rejecteItem/{id}', 'merchant\OrderController@rejecteItem');
    Route::post('deliverItem/{id}', 'merchant\OrderController@deliverItem');

    Route::post('acceptOrder/{id}', 'merchant\OrderController@acceptOrder');
    Route::post('deliveredOrder/{id}', 'merchant\OrderController@deliveredOrder');
    Route::post('rejectOrder', 'merchant\OrderController@rejectOrder');

    


    Route::get('profile', 'merchant\HomeController@editProfile');
    Route::post('updateProfile', 'merchant\HomeController@updateProfile')->name('merchant.updateProfile');
    Route::post('changePassword', 'merchant\HomeController@changePassword');
    
    Route::get('getRegions/{city_id}', 'merchant\HomeController@getRegions');
    Route::get('getCategories/{type_id}', 'merchant\HomeController@getCategories');//get categories according to type of merchant

    
    Route::resource('ticket', 'merchant\TicketController');
    
    

});
    // Route::get('/', 'merchant\HomeController@index')->name('merchant.dashboard');
    Route::get('login', 'merchant\Auth\MerchantLoginController@loginForm')->name('merchant.show.login');
    Route::post('login', 'merchant\Auth\MerchantLoginController@login')->name('merchant.login');
    Route::post('logout', 'merchant\Auth\MerchantLoginController@logout')->name('merchant.logout');

});