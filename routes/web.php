<?php

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

/**
 * Auth
 */
Route::group([
    'middleware' => 'app.locale',
    'namespace' => 'Auth'
], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

/**
 * Site
 */
Route::group([
    'middleware' => 'app.locale',
    'namespace' => 'Website'
], function () {
    Route::get('/', 'PageController@home')->name('home');
    Route::get('/services', 'PageController@services')->name('services');

    Route::get('/contacts', 'PageController@contacts')->name('contacts');
    Route::post('/contact-us', 'PageController@contactUs')->name('contact-us');

    Route::get('/search', 'PageController@search')->name('search');
    Route::get('/language/{locale}', 'PageController@languageChange')->name('language');

    Route::get('/equipment', 'EquipmentController@index')->name('equipment.index');
    Route::get('/equipment/{equipment}', 'EquipmentController@show')->name('equipment.show');

    Route::get('/parts', 'PartController@index')->name('parts.index');
    Route::get('/parts/filter', 'PartController@filter')->name('parts.filter');
    Route::get('/parts/{part}', 'PartController@show')->name('parts.show');

    Route::get('/news', 'NewsController@index')->name('news.index');
    Route::get('/news/{news}', 'NewsController@show')->name('news.show');

    Route::get('/cart', 'OrderController@cart')->name('cart');
    Route::get('/checkout', 'OrderController@checkout')->name('checkout');
    Route::get('/checkout/success/{id}', 'OrderController@checkoutSuccess')->name('checkout-success');
});





Route::group(['middleware' => 'app.locale'], function() {
//    // Catalog
//    Route::get('/catalog/{cid}', 'Website\CatalogController@catalogPage')->name('catalogPage');
//    Route::get('/catalog/{cid}/construct/figures', 'Website\CatalogController@figuresCatalogPage')->name('figuresCatalogPage');
//    // Nodes
//    Route::get('/node/{id}', 'Website\NodesController@singleNodePage')->name('singleNodePage');
//
//    // API
    Route::get('/api/cart/{userKey}', 'Website\OrderController@getCartPreviewData');
//    Route::get('/api/cart/{userKey}/table', 'Website\OrderController@getCartTableData');
//    Route::get('/api/cart/{userKey}/table-proceed', 'Website\OrderController@getCartProceedTableData');
//    Route::get('/api/cart/remove/{userKey}/{cart_node}', 'Website\OrderController@removeItemFromCart');
//    Route::post('/api/cart/actions/add/item', 'Website\OrderController@addItemToCart');
    Route::post('/api/cart/proceed/action', 'Website\OrderController@proceedOrderAPI')->name('proceedOrderAPI');
//
});





/**
 * Admin
 */
Route::group([
    'middleware' => ['auth', 'auth.admin'],
    'namespace' => 'Secured',
    'prefix' => 'secured/admin',
    'as' => 'admin.'
], function () {
    Route::resource('user', 'UserController', ['only' => ['edit', 'update']]);
    Route::resource('manufacturer', 'ManufacturerController', ['except' => ['show']]);
    Route::resource('equipment-group', 'EquipmentGroupController', ['except' => ['show']]);
    Route::put('equipment/update-site-position', 'EquipmentController@updateSitePosition')->name('equipment.update-site-position');
    Route::resource('equipment', 'EquipmentController', ['except' => ['show']]);
    Route::resource('catalog', 'CatalogController', ['except' => ['show']]);
    Route::resource('part', 'PartController', ['except' => ['show']]);

    Route::put('unit/get-parts', 'UnitController@getParts')->name('unit.get-parts');
    Route::get('unit/collapse-units-state', 'UnitController@collapseUnitsState')->name('unit.collapse-units-state');
    Route::resource('unit', 'UnitController', ['except' => ['show']]);

    Route::get('media/{media}', 'MediaController@destroy')->name('media.destroy');

    Route::get('importer', 'ImporterController@index')->name('importer.index');
    Route::get('importer/export', 'ImporterController@export')->name('importer.export');
    Route::put('importer/import', 'ImporterController@import')->name('importer.import');
});



Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'auth.admin'], function() {
        ########################################################################
        # Pages
        ########################################################################
        // Dashboard
        Route::get('/secured/admin', 'Secured\PageController@dashboard')->name('admin.dashboard');
        Route::get('/secured/admin/search', 'Secured\PageController@adminSearch')->name('admin.search');
        // Order
        Route::get('/secured/admin/orders', 'Secured\OrdersController@index')->name('admin.order.index');
        Route::get('/secured/admin/orders/{order}', 'Secured\OrdersController@edit')->name('admin.order.edit');

        // Catalog
//        Route::get('/secured/admin/catalog', 'Secured\CatalogController@index')->name('admin.catalog.index');
//        Route::get('/secured/admin/catalog/add', 'Secured\CatalogController@create')->name('admin.catalog.create');
//        Route::get('/secured/admin/catalog/edit/{catalog}', 'Secured\CatalogController@edit')->name('admin.catalog.edit');
//        Route::get('/secured/admin/catalog/delete/{cid}', 'Secured\CatalogController@securedDeleteCatalogItemPage')->name('securedDeleteCatalogItemPage');

        // Products
//        Route::get('/secured/admin/products/sections/{product_type}', 'Secured\SecuredProductsController@index')->name('admin.products.index');
//        Route::get('/secured/admin/products/{product_type}/add', 'Secured\SecuredProductsController@create')->name('admin.products.create');
//        Route::get('/secured/admin/products/{product_type}/{id}/actions/edit', 'Secured\SecuredProductsController@edit')->name('admin.products.edit');
//        Route::get('/secured/admin/products/{id}/actions/delete', 'Secured\SecuredProductsController@deleteNode')->name('deleteNode');

        // Parts Constructor
        Route::get('/secured/admin/constructor/list', 'Secured\PartsConstructor@index')->name('admin.figures.index');
        Route::get('/secured/admin/constructor/add/init', 'Secured\PartsConstructor@create')->name('admin.figures.create');
        Route::get('/secured/admin/constructor/add/create/{figure}', 'Secured\PartsConstructor@createConstructor')->name('admin.figures.constructor.create');
        Route::get('/secured/admin/constructor/add/delete/{figure}', 'Secured\PartsConstructor@delete')->name('admin.figures.delete');

        // Slider
        Route::get('/secured/admin/slider', 'Secured\SliderController@index')->name('admin.slider.index');
        Route::get('/secured/admin/slider/add', 'Secured\SliderController@create')->name('admin.slider.create');
        Route::get('/secured/admin/slider/edit/{slider}', 'Secured\SliderController@edit')->name('admin.slider.edit');
        Route::get('/secured/admin/slider/remove/{slider}', 'Secured\SliderController@destroy')->name('admin.slider.delete');

        // News
        Route::get('/secured/admin/news', 'Secured\NewsController@index')->name('admin.news.index');
        Route::get('/secured/admin/news/add', 'Secured\NewsController@create')->name('admin.news.create');
        Route::get('/secured/admin/news/edit/{news}', 'Secured\NewsController@edit')->name('admin.news.edit');
        Route::get('/secured/admin/news/remove/{news}', 'Secured\NewsController@destroy')->name('admin.news.delete');

        // Pages
        Route::get('/secured/admin/pages', 'Secured\PageController@index')->name('admin.pages.index');
        Route::get('/secured/admin/pages/edit/home', 'Secured\PageController@home')->name('admin.pages.home');
        Route::get('/secured/admin/pages/edit/services', 'Secured\PageController@services')->name('admin.pages.services');
        Route::get('/secured/admin/pages/edit/contacts', 'Secured\PageController@contacts')->name('admin.pages.contacts');
        Route::get('/secured/admin/pages/edit/{catalog}', 'Secured\PageController@catalog')->name('admin.pages.catalog');

        // Upload
//        Route::get('/secured/admin/upload/csv', 'Secured\PageController@uploadCSVPage')->name('uploadCSVPage');
        ########################################################################
        # API
        ########################################################################
        // Order
        Route::post('/api/v1.0/orders/change/status', 'Secured\OrderController@changeOrderStatusAPI')->name('changeOrderStatusAPI');
        Route::get('/api/v1.0/orders/change/products/{order_id}/{node_id}', 'Secured\OrderController@removeProductFromOrderAPI')->name('removeProductFromOrderAPI');
        Route::get('/api/v1.0/orders/change/delete/{id}', 'Secured\OrderController@removeOrderAPI')->name('removeOrderAPI');
        // Catalog
//        Route::post('/api/v1.0/catalog/new/save', 'Secured\CatalogController@saveNewCatalogItemAPI')->name('saveNewCatalogItemAPI');
//        Route::post('/api/v1.0/catalog/edit/update', 'Secured\CatalogController@updateCatalogItemAPI')->name('updateCatalogItemAPI');
        // Products
//        Route::post('/api/v1.0/products/equipment/save', 'Secured\ProductsController@saveNewEquipmentAPI')->name('saveNewEquipmentAPI');
//        Route::post('/api/v1.0/products/equipment/update', 'Secured\ProductsController@updateEquipmentAPI')->name('updateEquipmentAPI');

//        Route::post('/api/v1.0/products/parts/save', 'Secured\ProductsController@saveNewPartsAPI')->name('saveNewPartsAPI');
//        Route::post('/api/v1.0/products/parts/update', 'Secured\ProductsController@updatePartsAPI')->name('updatePartsAPI');

//        Route::get('/api/v1.0/products/images/remove/{id}', 'Secured\ProductsController@removeProductImage')->name('removeProductImage');
//        Route::get('/api/v1.0/products/remove/{id}', 'Secured\ProductsController@removeProductAPI')->name('removeProductAPI');
        // Parts Constructor
        Route::post('/api/v1.0/constructor/init/save', 'Secured\PartsConstructor@saveConstructorInitAPI')->name('saveConstructorInitAPI');
        Route::post('/api/v1.0/constructor/init/build/save', 'Secured\PartsConstructor@saveConstructorBuilderAPI')->name('saveConstructorBuilderAPI');
        Route::post('/api/v1.0/constructor/init/build/clear', 'Secured\PartsConstructor@clearConstructorBuilderAPI')->name('clearConstructorBuilderAPI');
        // Slider
        Route::post('/api/v1.0/slider/save', 'Secured\CommonController@saveNewSlideAPI')->name('saveNewSlideAPI');
        Route::post('/api/v1.0/slider/update', 'Secured\CommonController@updateSlideAPI')->name('updateSlideAPI');
        // Pages
        Route::post('/api/v1.0/pages/update', 'Secured\CommonController@updatePageItemAPI')->name('updatePageItemAPI');
        Route::post('/api/v1.0/pages/home/update', 'Secured\CommonController@updateHomePageItemAPI')->name('updateHomePageItemAPI');
        //News
        Route::post('/api/v1.0/news/save', 'Secured\CommonController@saveNewNewsItemAPI')->name('saveNewNewsItemAPI');
        Route::post('/api/v1.0/news/update', 'Secured\CommonController@updateNewsItemAPI')->name('updateNewsItemAPI');
        // Upload
//        Route::post('/api/v1.0/upload/csv/equipment', 'Secured\PageController@uploadEquipmentsCsvApi')->name('uploadEquipmentsCsvApi');
//        Route::post('/api/v1.0/upload/csv/parts', 'Secured\PageController@uploadPartsCsvApi')->name('uploadPartsCsvApi');
    });
});
