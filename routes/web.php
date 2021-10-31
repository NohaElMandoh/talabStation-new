<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return redirect()->to('/home');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::group(['prefix' => 'admin'], function () {
//     Voyager::routes();
// });
// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });


// -------------------------


Route::get('/', function () {
    return redirect()->to('/admin');
});

Auth::routes();

Route::get('/run', 'MainController@index');
// Route::get('/home', 'HomeController@index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
});

// admin routes
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    // Route::get('/', 'HomeController@index');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::resource('city', 'CityController');

    Route::resource('unit', 'UnitController',['except'=>['update']]);
    Route::post('unitUpdate/{id}', 'UnitController@update');

    Route::resource('region', 'RegionController',['except'=>['update']]);
    Route::post('regionUpdate/{id}', 'RegionController@update');

    Route::resource('type', 'TypeController',['except'=>['update']]);
    Route::post('typeUpdate/{id}', 'TypeController@update');


    Route::resource('city', 'CityController',['except'=>['update']]);
    Route::post('cityUpdate/{id}', 'CityController@update');


    Route::resource('category', 'CategoryController',['except'=>['update']]);
    Route::post('categoryUpdate/{id}', 'CategoryController@update');


    Route::resource('galary', 'GalaryController',['except'=>['update']]);
    Route::post('galaryUpdate/{id}', 'GalaryController@update');
    Route::post('galary/{id}/display', 'GalaryController@display');
    Route::post('galary/{id}/no-display', 'GalaryController@noDisplay');

    Route::resource('offer', 'OfferController',['except'=>['update']]);

    
    Route::post('offerUpdate/{id}', 'OfferController@update');

    Route::post('offer/{id}/notify', 'OfferController@notify');
    Route::post('offer/{id}/no-notify', 'OfferController@noNotify');


    Route::get('merchant/{id}/activate', 'MerchantController@activate');
    Route::get('merchant/{id}/de-activate', 'MerchantController@deActivate');
    Route::resource('merchant', 'MerchantController',['except'=>['update']]);
    Route::post('merchantUpdate/{id}', 'MerchantController@update');
    Route::get('showItems/{id}', 'MerchantController@showItems');
    Route::post('changePassword', 'MerchantController@changePassword');

    

    Route::resource('item', 'ItemController',['except'=>['destroy','update','edit','create']]);
    Route::post('item/delete/{id}', 'ItemController@destroy');
    Route::get('item/edit/{id}', 'ItemController@edit');
    Route::get('item/create/{id}', 'ItemController@create');
    Route::post('item/update/{id}', 'ItemController@update');




    Route::resource('order', 'OrderController', ['except' => ['update']]);
    Route::post('update-order/{order_id}', 'OrderController@update');

    Route::post('addRunner', 'OrderController@addRunner')->name('admin.addRunner');
    Route::get('assignRunner/{order_id}', 'OrderController@assignRunner');
    Route::get('getRegions/{city_id}', 'MerchantController@getRegions');

    Route::get('getCategories/{type_id}', 'MerchantController@getCategories');//get categories according to type of merchant

    Route::post('acceptDeliverOrder', 'OrderController@acceptDeliverOrder')->name('admin.acceptDeliverOrder');


    Route::resource('transaction', 'TransactionController');
    //    Route::resource('page','PageController');
    Route::resource('payment-method', 'PaymentMethodController');
    Route::resource('delivery-method', 'DeliveryMethodController');
    Route::resource('contact', 'ContactController');

    Route::resource('client', 'ClientController',['except'=>['update']]);
    Route::post('clientUpdate/{id}', 'ClientController@update');

    Route::resource('runner', 'RunnerController');


    Route::get('settings', 'SettingsController@view');
    Route::post('updateSettings', 'SettingsController@update');

    // user reset
    Route::get('user/change-password', 'UserController@changePassword');
    Route::post('user/change-password', 'UserController@changePasswordSave');
    //    Route::resource('user','UserController');
       Route::resource('role','RoleController');
       Route::resource('notification','NotificationController');

    Route::get('items_merchant/{id}', 'OfferController@items_merchant');
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