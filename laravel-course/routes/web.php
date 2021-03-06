<?php
// Estuda: OK
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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/product/{slug}', 'HomeController@single')->name('product.single');

Route::get('/category/{slug}', 'CategoryController@index')->name('category.index');

Route::get('/store/{slug}', 'StoreController@index')->name('store.index');

Route::prefix('cart')->name('cart.')->group(function() {
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('/checkout')->name('checkout.')->group(function() {
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
    Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');
});

// Adicionando para as rotas que estão dentro do grupo, um middleware de verificação de autenticação do usuário
Route::group(['middleware' => ['auth']], function () {
    Route::get('my-orders', 'UserOrderController@index')->name('user-order.index');

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
        // Route::prefix('stores')->name('stores.')->group(function () {
        //     // Route::get('/stores', 'Admin\\StoreController@index');
        //     Route::get('/', 'StoreController@index')->name('index');
        //     Route::get('/create', 'StoreController@create')->name('create');
        //     Route::post('/store', 'StoreController@store')->name('store');
        //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
        //     Route::post('/update/{store}', 'StoreController@update')->name('update');
        //     Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
        // });
        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');

        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');

        Route::get('orders/my', 'OrderController@index')->name('order.index');

        Route::get('notifications', 'NotificationController@notifications')->name('notification.index');
        Route::get('notifications/read/all', 'NotificationController@readAll')->name('notification.readNotification.all');
        Route::get('notifications/read/{notificationId}', 'NotificationController@readSpecificNotification')->name('notification.readNotification.specific');
    });
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('notification', function() {
    $user = \App\User::find(1);

    // Salvar a notificalção dentro do banco de dados
    // $user->notify(new \App\Notifications\StoreReceiveNewOrder());

    // Retornar todas as notificações, tanto as lidas quanto as não lidas
    $allNotifications = $user->notifications;

    // $notification = $user->notifications->first();
    // Fazer com que uma notificação seja marcada como lida
    // $notification->markAsRead();

    // Retornar todas as notificações lidas
    $readNotifications = $user->readNotifications;

    // Retornar todas as notificações não lidas
    $unreadNotifications = $user->unreadNotifications;

    return $allNotifications;
});
