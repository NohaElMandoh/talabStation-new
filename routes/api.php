<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' =>'v1'],function(){

    Route::get('categories','App\Http\Controllers\Api\MainController@categories');
   
    Route::post('images','App\Http\Controllers\Api\MainController@galary');
    Route::post('registerGeust','App\Http\Controllers\Api\AuthController@registerGeust');
    

    Route::post('register-token_general', 'App\Http\Controllers\Api\AuthController@registerToken');

    Route::post('categories_merchant','App\Http\Controllers\Api\MainController@categories_merchant');

    
    Route::get('types','App\Http\Controllers\Api\MainController@types');

    Route::post('newCategory','App\Http\Controllers\Api\MainController@newCategory');
    Route::post('newOfferTitle','App\Http\Controllers\Api\MainController@newOfferTitle');

    
    Route::post('items_category','App\Http\Controllers\Api\MainController@items_category');
    Route::get('units','App\Http\Controllers\Api\MainController@units');
    Route::post('allItems','App\Http\Controllers\Api\MainController@allItems');
    Route::post('merchants_category','App\Http\Controllers\Api\MainController@merchants_category');
    Route::post('merchants_type','App\Http\Controllers\Api\MainController@merchants_type');

    Route::post('items_category_merchant','App\Http\Controllers\Api\MainController@items_category_merchant');
    Route::post('addMerchantToSelectedList','App\Http\Controllers\Api\MainController@addMerchantToSelectedList');

    
    
    Route::post('newUnit','App\Http\Controllers\Api\MainController@newUnit');
    Route::post('newType','App\Http\Controllers\Api\MainController@newType');


    Route::get('cities','App\Http\Controllers\Api\MainController@cities');//done
    Route::post('newCity','App\Http\Controllers\Api\MainController@newCity');

    Route::get('regions','App\Http\Controllers\Api\MainController@regions');
    Route::post('newRegion','App\Http\Controllers\Api\MainController@newRegion');


    Route::get('cities-not-paginated','App\Http\Controllers\Api\MainController@citiesNotPaginated');
    Route::get('regions-not-paginated','App\Http\Controllers\Api\MainController@regionsNotPaginated');
    Route::get('regions_ajax','App\Http\Controllers\Api\MainController@ajax_region');
    Route::get('delivery-methods','App\Http\Controllers\Api\MainController@deliveryMethods');
    Route::get('delivery-times','App\Http\Controllers\Api\MainController@deliveryTimes');
    Route::get('payment-methods','App\Http\Controllers\Api\MainController@paymentMethods');

    Route::get('merchants','App\Http\Controllers\Api\MainController@merchants');
    Route::get('restaurants','App\Http\Controllers\Api\MainController@restaurants');

    
    Route::get('merchant','App\Http\Controllers\Api\MainController@merchant');
    Route::get('items','App\Http\Controllers\Api\MainController@items');
    Route::post('merchant/reviews','App\Http\Controllers\Api\MainController@reviews');
    Route::get('list_merchantsReviews','App\Http\Controllers\Api\MainController@list_merchantsReviews');
    Route::post('list_merchantsoffers','App\Http\Controllers\Api\MainController@list_merchantsoffers');
    Route::get('list_newMerchants','App\Http\Controllers\Api\MainController@list_newMerchants');
    Route::get('list_selectedMerchants','App\Http\Controllers\Api\MainController@list_selectedMerchants');
    Route::get('list_TalabStationOffers','App\Http\Controllers\Api\MainController@list_TalabStationOffers');


    

    
    Route::post('offers','App\Http\Controllers\Api\MainController@offers');
    Route::get('offer','App\Http\Controllers\Api\MainController@offer');
    Route::post('contactUs','App\Http\Controllers\Api\MainController@contactUs');

    Route::get('settings','App\Http\Controllers\Api\MainController@settings');

    // test notification
    Route::post('test-notification','App\Http\Controllers\Api\MainController@testNotification');
    Route::post('test-pusher','App\Http\Controllers\Api\MainController@testPusher');

    Route::post('guest/new-order','App\Http\Controllers\Api\Client\MainController@newOrderByGuest');

    Route::group(['prefix' =>'client'],function(){

        Route::post('registerClient', 'App\Http\Controllers\Api\Client\AuthController@registerClient');//done
        Route::post('registerSocial', 'App\Http\Controllers\Api\Client\AuthController@registerSocial');//done
        Route::post('registerPhone', 'App\Http\Controllers\Api\Client\AuthController@registerPhone');//done

        
        Route::post('login', 'App\Http\Controllers\Api\Client\AuthController@login');//done
        Route::post('profile', 'App\Http\Controllers\Api\Client\AuthController@profile');//done
        Route::post('reset-password', 'App\Http\Controllers\Api\Client\AuthController@reset');
        Route::post('new-password', 'App\Http\Controllers\Api\Client\AuthController@password');
        Route::post('checkEmail', 'App\Http\Controllers\Api\Client\AuthController@checkEmail');
        Route::post('checkPhone', 'App\Http\Controllers\Api\Client\AuthController@checkPhone');

        
        Route::post('verifyEmail', 'App\Http\Controllers\Api\Client\AuthController@verifyEmail');
        Route::post('resendCodeToEmail', 'App\Http\Controllers\Api\Client\AuthController@resendCodeToEmail');
        
        

        Route::group(['middleware'=>'auth:client'],function(){
            Route::post('profile', 'App\Http\Controllers\Api\Client\AuthController@profile');//done
            Route::post('register-token', 'App\Http\Controllers\Api\Client\AuthController@registerToken');
            Route::post('remove-token', 'App\Http\Controllers\Api\Client\AuthController@removeToken');
            


            Route::post('add-item-to-cart','App\Http\Controllers\Api\Client\MainController@addItemToCart');
            Route::post('add-spacial-item-to-cart','App\Http\Controllers\Api\Client\MainController@addSpacialItemToCart');

            
            Route::post('delete-item-from-cart','App\Http\Controllers\Api\Client\MainController@deleteItemFromCart');
            Route::post('delete-all-cart-items','App\Http\Controllers\Api\Client\MainController@deleteAllCartItems');
            Route::post('update-cart-item','App\Http\Controllers\Api\Client\MainController@updateCartItem');
            Route::get('get-cart-items','App\Http\Controllers\Api\Client\MainController@cartItems');
            Route::post('new-order','App\Http\Controllers\Api\Client\MainController@newOrder');
            Route::post('delete-order','App\Http\Controllers\Api\Client\MainController@deleteOrder');
            Route::get('merchantsToRate','App\Http\Controllers\Api\Client\MainController@merchantsToRate');

            
            Route::post('my-orders','App\Http\Controllers\Api\Client\MainController@myOrders');
            Route::get('show-order','App\Http\Controllers\Api\Client\MainController@showOrder');
            Route::get('latest-order','App\Http\Controllers\Api\Client\MainController@latestOrder');
            Route::post('confirm-order','App\Http\Controllers\Api\Client\MainController@confirmOrder');
            Route::post('decline-order','App\Http\Controllers\Api\Client\MainController@declineOrder');

            Route::post('merchant/review','App\Http\Controllers\Api\Client\MainController@review');
            Route::post('runner/runnerReview','App\Http\Controllers\Api\Client\MainController@runnerReview');

            
            Route::get('notifications','App\Http\Controllers\Api\Client\MainController@notifications');
            Route::post('updateSettings','App\Http\Controllers\Api\Client\MainController@updateSettings');

            Route::post('additionalMerchant','App\Http\Controllers\Api\Client\MainController@additionalMerchant');


            
        });
    });
    Route::group(['prefix' =>'runner'],function(){

        Route::post('register', 'App\Http\Controllers\Api\Runner\AuthController@register');//done
        Route::post('login', 'App\Http\Controllers\Api\Runner\AuthController@login');//done
        Route::post('profile', 'App\Http\Controllers\Api\Runner\AuthController@profile');//done
        Route::post('reset-password', 'App\Http\Controllers\Api\Runner\AuthController@reset');
        Route::post('new-password', 'App\Http\Controllers\Api\Runner\AuthController@password');

        Route::group(['middleware'=>'auth:runner'],function(){
            Route::post('profile', 'App\Http\Controllers\Api\Runner\AuthController@profile');//done
            Route::post('register-token', 'App\Http\Controllers\Api\Runner\AuthController@registerToken');
            Route::post('remove-token', 'App\Http\Controllers\Api\Runner\AuthController@removeToken');


            Route::get('my-orders','App\Http\Controllers\Api\Runner\MainController@myOrders');
            Route::get('show-order','App\Http\Controllers\Api\Runner\MainController@showOrder');
            Route::get('latest-order','App\Http\Controllers\Api\Runner\MainController@latestOrder');
            Route::post('confirm-order','App\Http\Controllers\Api\Runner\MainController@confirmOrder');
            Route::post('acceptDeliverOrder','App\Http\Controllers\Api\Runner\MainController@acceptDeliverOrder');

            
            Route::post('decline-order','App\Http\Controllers\Api\Runner\MainController@declineOrder');

            Route::post('restaurant/review','App\Http\Controllers\Api\Runner\MainController@review');
            Route::get('notifications','App\Http\Controllers\Api\Runner\MainController@notifications');
            Route::post('updateSettings','App\Http\Controllers\Api\Runner\MainController@updateSettings');

            
        });
    });
    Route::group(['prefix' =>'merchant'],function(){

        Route::post('register', 'App\Http\Controllers\Api\Merchant\AuthController@register');
        Route::post('login', 'App\Http\Controllers\Api\Merchant\AuthController@login');
        Route::post('checkEmail', 'App\Http\Controllers\Api\Merchant\AuthController@checkEmail');

        
        Route::post('profile', 'App\Http\Controllers\Api\Merchant\AuthController@profile');
        Route::post('reset-password', 'App\Http\Controllers\Api\Merchant\AuthController@reset');
        Route::post('new-password', 'App\Http\Controllers\Api\Merchant\AuthController@password');

        Route::group(['middleware'=>'auth:merchant'],function(){
            
            Route::get('allRunners','App\Http\Controllers\Api\Merchant\MainController@allRunners');
            Route::get('myRunners','App\Http\Controllers\Api\Merchant\MainController@myRunners');
            Route::post('assignRunner', 'App\Http\Controllers\Api\Merchant\MainController@assignRunner');
            Route::post('addRunner', 'App\Http\Controllers\Api\Merchant\MainController@addRunner');
            Route::post('removeRunner', 'App\Http\Controllers\Api\Merchant\MainController@removeRunner');

            Route::post('update-categories', 'App\Http\Controllers\Api\Merchant\MainController@updateCategories');

            Route::post('profile', 'App\Http\Controllers\Api\Merchant\AuthController@profile')->middleware('check-commissions');
            Route::post('register-token', 'App\Http\Controllers\Api\Merchant\AuthController@registerToken');
            Route::post('remove-token', 'App\Http\Controllers\Api\Merchant\AuthController@removeToken');

            
            Route::get('myCategories','App\Http\Controllers\Api\Merchant\MainController@myCategories');

            Route::post('my-items','App\Http\Controllers\Api\Merchant\MainController@myItems');
            Route::post('new-item','App\Http\Controllers\Api\Merchant\MainController@newItem')->middleware('check-commissions');
            Route::post('update-item','App\Http\Controllers\Api\Merchant\MainController@updateItem')->middleware('check-commissions');
            Route::post('delete-item','App\Http\Controllers\Api\Merchant\MainController@deleteItem')->middleware('check-commissions');

            Route::get('my-offers','App\Http\Controllers\Api\Merchant\MainController@myOffers');
            Route::post('new-offer','App\Http\Controllers\Api\Merchant\MainController@newOffer')->middleware('check-commissions');
            Route::post('update-offer','App\Http\Controllers\Api\Merchant\MainController@updateOffer')->middleware('check-commissions');
            Route::post('delete-offer','App\Http\Controllers\Api\Merchant\MainController@deleteOffer')->middleware('check-commissions');

            Route::get('my-orders','App\Http\Controllers\Api\Merchant\MainController@myOrders');
            Route::get('show-order','App\Http\Controllers\Api\Merchant\MainController@showOrder');
            Route::post('confirm-order','App\Http\Controllers\Api\Merchant\MainController@confirmOrder')->middleware('check-commissions');
            Route::post('accept-order','App\Http\Controllers\Api\Merchant\MainController@acceptOrder')->middleware('check-commissions');
            Route::post('reject-order','App\Http\Controllers\Api\Merchant\MainController@rejectOrder')->middleware('check-commissions');
            Route::get('notifications','App\Http\Controllers\Api\Merchant\MainController@notifications');
            Route::post('change-state','App\Http\Controllers\Api\Merchant\MainController@changeState')->middleware('check-commissions');
            
            Route::get('commissions','App\Http\Controllers\Api\Merchant\MainController@commissions');
        });
    });

    Route::post('insertOBD', 'App\Http\Controllers\Api\FuelController@newOPD');
}
);
