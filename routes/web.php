<?php
/**
 * Admin
 */
Route::namespace('Auth')->group(function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::group([
    'middleware' => ['auth', 'auth.admin'],
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('search', 'DashboardController@search')->name('search');
    Route::get('download-backup', 'DashboardController@downloadBackup')->name('download.backup');

    Route::resource('pages', 'PageController', ['except' => ['show']]);

    Route::get('profile/{user:name}', 'UserController@profile')->name('profile.edit');
    Route::put('profile/{user}', 'UserController@update')->name('profile.update');

    Route::resource('manufacturers', 'ManufacturerController', ['except' => ['show']]);
    Route::resource('equipment-groups', 'EquipmentGroupController', ['except' => ['show']]);

    Route::post('equipment/{equipment}/clone', 'EquipmentController@cloneEquipment')->name('equipment.clone');
    Route::put('equipment/update-site-position', 'EquipmentController@updateSitePosition')->name('equipment.update-site-position');
    Route::resource('equipment', 'EquipmentController', ['except' => ['show']]);

    Route::resource('catalogs', 'CatalogController', ['except' => ['show']]);
    Route::resource('parts', 'PartController', ['except' => ['show']]);
    Route::resource('slides', 'SlideController', ['except' => ['show']]);
    Route::resource('posts', 'PostController', ['except' => ['show']]);

    Route::put('unit/get-parts', 'UnitController@getParts')->name('units.get-parts');
    Route::get('unit/collapse-units-state', 'UnitController@collapseUnitsState')->name('units.collapse-units-state');
    Route::resource('units', 'UnitController', ['except' => ['show']]);

    Route::get('media/{media}', 'MediaController@destroy')->name('media.destroy');

    Route::get('importer', 'ImporterController@index')->name('importer.index');
    Route::get('importer/export', 'ImporterController@export')->name('importer.export');
    Route::put('importer/import', 'ImporterController@import')->name('importer.import');

    Route::get('orders', 'OrderController@index')->name('orders.index');
    Route::get('orders/{order}', 'OrderController@edit')->name('orders.edit');
    Route::patch('orders/{order}/change-status', 'OrderController@changeStatus')->name('orders.changeStatus');
    Route::delete('orders/{orderProduct}/delete-product', 'OrderController@deleteProduct')->name('orders.deleteProduct');
    Route::delete('orders/{order}', 'OrderController@destroy')->name('orders.destroy');

    Route::put('offices/update-site-position', 'OfficeController@updateSitePosition')->name('offices.update-site-position');
    Route::resource('offices', 'OfficeController', ['except' => ['show']]);

    Route::get('settings', 'SettingController@index')->name('settings');
    Route::post('settings', 'SettingController@store')->name('settings.store');

    Route::group(['prefix' => 'filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

/**
 * Website
 */
Route::group(['middleware' => ['check.cart'], 'namespace' => 'Website'], function () {
    Route::get('/', 'PageController@home')->name('home');
    Route::get('/contacts', 'PageController@contacts')->name('contacts');
    Route::post('/contact-us', 'PageController@contactUs')->name('contact-us');

    Route::get('/search', 'PageController@search')->name('search');
    Route::get('/language/{locale}', 'PageController@languageChange')->name('language');

    Route::get('/equipment', 'EquipmentController@index')->name('equipment.index');
    Route::get('/equipment/{equipment:slug}', 'EquipmentController@show')->name('equipment.show');

    Route::get('/parts', 'PartController@index')->name('parts.index');
    Route::get('/parts/filter', 'PartController@filter')->name('parts.filter');
    Route::get('/parts/{part:slug}', 'PartController@show')->name('parts.show');

    Route::get('/blog', 'PostController@index')->name('posts.index');
    Route::get('/blog/{post:slug}', 'PostController@show')->name('posts.show');

    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart/store', 'CartController@store')->name('cart.store');
    Route::patch('/cart/update', 'CartController@update')->name('cart.update');
    Route::delete('/cart/remove', 'CartController@remove')->name('cart.remove');

    Route::get('/checkout', 'CheckoutController@index')->name('checkout');
    Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');

    Route::post('/subscribe', 'SubscribeController@store')->name('subscribe');
    Route::get('/subscribe/confirm/{subscriber}', 'SubscribeController@confirmSuccess')->name('subscribe.confirm-success');

    Route::get('/unsubscribe/{subscriber}', 'SubscribeController@edit')->name('unsubscribe.edit');
    Route::delete('/unsubscribe/{subscriber}', 'SubscribeController@destroy')->name('unsibscribe.destroy');

    Route::post('/apply-funding', 'PageController@applyFunding')->name('apply-funding');
});


// Route for dynamic pages (catch all page controller)
// IMPORTANT: this route must be placed after all routes
Route::group(['middleware' => ['check.cart'], 'namespace' => 'Website'], function () {
    Route::get('{slug}', [
        'as' => 'dynamicPage',
        'uses' => 'PageController@dynamicPage'
    ])->where('slug', '([A-Za-z0-9\-\/]+)');
});
