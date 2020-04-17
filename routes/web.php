<?php

Route::middleware('app.locale')->group(function() {
   Route::namespace('Auth')->group(function () {
       Route::get('login', 'LoginController@showLoginForm')->name('login');
       Route::post('login', 'LoginController@login');
       Route::post('logout', 'LoginController@logout')->name('logout');
   });

    Route::namespace('Website')->group(function () {
        Route::get('/', 'PageController@home')->name('home');
        Route::get('/services', 'PageController@services')->name('services');

        Route::get('/contacts', 'PageController@contacts')->name('contacts');
        Route::post('/contact-us', 'PageController@contactUs')->name('contact-us');

        Route::get('/search', 'PageController@search')->name('search');
        Route::get('/language/{locale}', 'PageController@languageChange')->name('language');

        Route::get('/equipment', 'EquipmentController@index')->name('equipment.index');
        Route::get('/equipment/{equipment:slug}', 'EquipmentController@show')->name('equipment.show');

        Route::get('/parts', 'PartController@index')->name('parts.index');
        Route::get('/parts/filter', 'PartController@filter')->name('parts.filter');
        Route::get('/parts/{part:slug}', 'PartController@show')->name('parts.show');

        Route::get('/news', 'NewsController@index')->name('news.index');
        Route::get('/news/{news:slug}', 'NewsController@show')->name('news.show');

        Route::get('/cart', 'CartController@index')->name('cart');
        Route::post('/cart/store', 'CartController@store')->name('cart.store');
        Route::patch('/cart/update', 'CartController@update')->name('cart.update');
        Route::delete('/cart/remove', 'CartController@remove')->name('cart.remove');

        Route::get('/checkout', 'CheckoutController@index')->name('checkout');
        Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
    });
});


/**
 * Admin
 */
Route::group([
    'middleware' => ['auth', 'auth.admin'],
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('/', 'PageController@dashboard')->name('dashboard');
    Route::get('search', 'PageController@adminSearch')->name('search');

    Route::get('profile/{user:name}', 'UserController@profile')->name('profile.edit');
    Route::put('profile/{user}', 'UserController@update')->name('profile.update');
    Route::resource('manufacturers', 'ManufacturerController', ['except' => ['show']]);
    Route::resource('equipment-groups', 'EquipmentGroupController', ['except' => ['show']]);
    Route::put('equipment/update-site-position', 'EquipmentController@updateSitePosition')->name('equipment.update-site-position');
    Route::resource('equipment', 'EquipmentController', ['except' => ['show']]);
    Route::resource('catalogs', 'CatalogController', ['except' => ['show']]);
    Route::resource('parts', 'PartController', ['except' => ['show']]);
    Route::resource('slides', 'SlideController', ['except' => ['show']]);
    Route::resource('news', 'NewsController', ['except' => ['show']]);

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
});




// TODO: need to be refactoring
Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'auth.admin', 'namespace' => 'Admin'], function() {
        // Parts Constructor
//        Route::get('/secured/admin/constructor/list', 'PartsConstructor@index')->name('admin.figures.index');
//        Route::get('/secured/admin/constructor/add/init', 'PartsConstructor@create')->name('admin.figures.create');
//        Route::get('/secured/admin/constructor/add/create/{figure}', 'PartsConstructor@createConstructor')->name('admin.figures.constructor.create');
//        Route::get('/secured/admin/constructor/add/delete/{figure}', 'PartsConstructor@delete')->name('admin.figures.delete');
//        Route::post('/api/v1.0/constructor/init/save', 'PartsConstructor@saveConstructorInitAPI')->name('saveConstructorInitAPI');
//        Route::post('/api/v1.0/constructor/init/build/save', 'PartsConstructor@saveConstructorBuilderAPI')->name('saveConstructorBuilderAPI');
//        Route::post('/api/v1.0/constructor/init/build/clear', 'PartsConstructor@clearConstructorBuilderAPI')->name('clearConstructorBuilderAPI');

        // Pages
        Route::get('admin/pages', 'PageController@index')->name('admin.pages.index');
        Route::get('admin/pages/edit/home', 'PageController@home')->name('admin.pages.home');
        Route::get('admin/pages/edit/services', 'PageController@services')->name('admin.pages.services');
        Route::get('admin/pages/edit/contacts', 'PageController@contacts')->name('admin.pages.contacts');
        Route::get('admin/pages/edit/{catalog}', 'PageController@catalog')->name('admin.pages.catalog');
        Route::post('/api/v1.0/pages/update', 'CommonController@updatePageItemAPI')->name('updatePageItemAPI');
        Route::post('/api/v1.0/pages/home/update', 'CommonController@updateHomePageItemAPI')->name('updateHomePageItemAPI');
    });
});