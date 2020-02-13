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
Route::group(['middleware' => 'app.locale'], function() {
    Auth::routes();
    Route::get('/home', function() {
        return redirect()->back();
    })->name('home');
    //======================================================================
    // WEBSITE
    //======================================================================
    ########################################################################
    # Public routes
    ########################################################################
    Route::get('/', 'Website\PagesController@homePage')->name('homePage');
    Route::get('/lang-switch/{lang}', 'Website\PagesController@langSwitcherPage')->name('langSwitcherPage');
    Route::get('/services', 'Website\PagesController@servicesPage')->name('servicesPage');
    Route::get('/contacts', 'Website\PagesController@contactsPage')->name('contactsPage');
    Route::get('/search/results', 'Website\PagesController@searchResults')->name('searchResults');
    // Catalog
    Route::get('/catalog/{cid}', 'Website\CatalogController@catalogPage')->name('catalogPage');
    Route::get('/catalog/{cid}/construct/figures', 'Website\CatalogController@figuresCatalogPage')->name('figuresCatalogPage');
    // Nodes
    Route::get('/node/{id}', 'Website\NodesController@singleNodePage')->name('singleNodePage');
    // Cart
    Route::get('/cart', 'Website\OrdersController@cartPage')->name('cartPage');
    Route::get('/cart/checkout', 'Website\OrdersController@cartPage')->name('cartPage');
    Route::get('/cart/checkout/proceed', 'Website\OrdersController@cartProceedPage')->name('cartProceedPage');
    Route::get('/cart/checkout/success/{id}', 'Website\OrdersController@cartProceedSuccessPage')->name('cartProceedSuccessPage');
    // News
    Route::get('/news', 'Website\PagesController@newsPage')->name('newsPage');
    Route::get('/news/{nw_id}', 'Website\PagesController@singleNewsPage')->name('singleNewsPage');
    // API
    Route::get('/api/cart/{userKey}', 'Website\OrdersController@getCartPreviewData');
    Route::get('/api/cart/{userKey}/table', 'Website\OrdersController@getCartTableData');
    Route::get('/api/cart/{userKey}/table-proceed', 'Website\OrdersController@getCartProceedTableData');
    Route::get('/api/cart/remove/{userKey}/{cart_node}', 'Website\OrdersController@removeItemFromCart');
    Route::post('/api/cart/actions/add/item', 'Website\OrdersController@addItemToCart');
    Route::post('/api/cart/proceed/action', 'Website\OrdersController@proceedOrderAPI')->name('proceedOrderAPI');
    Route::post('/api/contacts/mail/send', 'Website\PagesController@sendContactsMail')->name('sendContactsMail');
    ########################################################################
    # Auth routes
    ########################################################################
    Route::group(['middleware' => 'auth'], function() {
        Route::group(['middleware' => 'auth.active'], function() {

        });
    });
});
//======================================================================
// ADMIN PANEL
//======================================================================
Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'auth.admin'], function() {
        ########################################################################
        # Pages
        ########################################################################
        // Dashboard
        Route::get('/secured/admin', 'Secured\SecuredPagesController@dashboard')->name('dashboard');
        Route::get('/secured/admin/search', 'Secured\SecuredPagesController@adminSearch')->name('adminSearch');
        // Order
        Route::get('/secured/admin/orders', 'Secured\SecuredOrdersController@index')->name('admin.order.index');
        Route::get('/secured/admin/orders/{order}', 'Secured\SecuredOrdersController@edit')->name('admin.order.edit');

        // Catalog
        Route::get('/secured/admin/catalog', 'Secured\SecuredCatalogController@index')->name('admin.catalog.index');
        Route::get('/secured/admin/catalog/add', 'Secured\SecuredCatalogController@create')->name('admin.catalog.create');
        Route::get('/secured/admin/catalog/edit/{catalog}', 'Secured\SecuredCatalogController@edit')->name('admin.catalog.edit');
        Route::get('/secured/admin/catalog/delete/{cid}', 'Secured\SecuredCatalogController@securedDeleteCatalogItemPage')->name('securedDeleteCatalogItemPage');
        // Products
        Route::get('/secured/admin/products/sections/{product_type}', 'Secured\SecuredProductsController@index')->name('admin.products.index');
        Route::get('/secured/admin/products/{product_type}/add', 'Secured\SecuredProductsController@create')->name('admin.products.create');
        Route::get('/secured/admin/products/{product_type}/{id}/actions/edit', 'Secured\SecuredProductsController@edit')->name('admin.products.edit');
        Route::get('/secured/admin/products/{id}/actions/delete', 'Secured\SecuredProductsController@deleteNode')->name('deleteNode');

        // Parts Constructor
        Route::get('/secured/admin/constructor/list', 'Secured\SecuredPartsConstructor@index')->name('admin.figures.index');
        Route::get('/secured/admin/constructor/add/init', 'Secured\SecuredPartsConstructor@create')->name('admin.figures.create');
        Route::get('/secured/admin/constructor/add/create/{figure}', 'Secured\SecuredPartsConstructor@createConstructor')->name('admin.figures.constructor.create');
        Route::get('/secured/admin/constructor/add/delete/{figure}', 'Secured\SecuredPartsConstructor@delete')->name('admin.figures.delete');

        // Slider
        Route::get('/secured/admin/slider', 'Secured\SecuredSliderController@index')->name('admin.slider.index');
        Route::get('/secured/admin/slider/add', 'Secured\SecuredSliderController@create')->name('admin.slider.create');
        Route::get('/secured/admin/slider/edit/{slider}', 'Secured\SecuredSliderController@edit')->name('admin.slider.edit');
        Route::get('/secured/admin/slider/remove/{slider}', 'Secured\SecuredSliderController@delete')->name('admin.slider.delete');

        // News
        Route::get('/secured/admin/news', 'Secured\SecuredNewsController@index')->name('admin.news.index');
        Route::get('/secured/admin/news/add', 'Secured\SecuredNewsController@create')->name('admin.news.create');
        Route::get('/secured/admin/news/edit/{news}', 'Secured\SecuredNewsController@edit')->name('admin.news.edit');
        Route::get('/secured/admin/news/remove/{news}', 'Secured\SecuredNewsController@delete')->name('admin.news.delete');

        // Pages
        Route::get('/secured/admin/pages', 'Secured\SecuredPagesController@index')->name('admin.pages.index');
        Route::get('/secured/admin/pages/edit/home', 'Secured\SecuredPagesController@home')->name('admin.pages.home');
        Route::get('/secured/admin/pages/edit/services', 'Secured\SecuredPagesController@services')->name('admin.pages.services');
        Route::get('/secured/admin/pages/edit/contacts', 'Secured\SecuredPagesController@contacts')->name('admin.pages.contacts');
        Route::get('/secured/admin/pages/edit/{catalog}', 'Secured\SecuredPagesController@catalog')->name('admin.pages.catalog');

        // Upload
        Route::get('/secured/admin/upload/csv', 'Secured\SecuredPagesController@uploadCSVPage')->name('uploadCSVPage');
        ########################################################################
        # API
        ########################################################################
        // Order
        Route::post('/api/v1.0/orders/change/status', 'Secured\SecuredOrdersController@changeOrderStatusAPI')->name('changeOrderStatusAPI');
        Route::get('/api/v1.0/orders/change/products/{order_id}/{node_id}', 'Secured\SecuredOrdersController@removeProductFromOrderAPI')->name('removeProductFromOrderAPI');
        Route::get('/api/v1.0/orders/change/delete/{id}', 'Secured\SecuredOrdersController@removeOrderAPI')->name('removeOrderAPI');
        // Catalog
        Route::post('/api/v1.0/catalog/new/save', 'Secured\SecuredCatalogController@saveNewCatalogItemAPI')->name('saveNewCatalogItemAPI');
        Route::post('/api/v1.0/catalog/edit/update', 'Secured\SecuredCatalogController@updateCatalogItemAPI')->name('updateCatalogItemAPI');
        // Products
        Route::post('/api/v1.0/products/equipment/save', 'Secured\SecuredProductsController@saveNewEquipmentAPI')->name('saveNewEquipmentAPI');
        Route::post('/api/v1.0/products/equipment/update', 'Secured\SecuredProductsController@updateEquipmentAPI')->name('updateEquipmentAPI');

        Route::post('/api/v1.0/products/parts/save', 'Secured\SecuredProductsController@saveNewPartsAPI')->name('saveNewPartsAPI');
        Route::post('/api/v1.0/products/parts/update', 'Secured\SecuredProductsController@updatePartsAPI')->name('updatePartsAPI');

        Route::get('/api/v1.0/products/images/remove/{id}', 'Secured\SecuredProductsController@removeProductImage')->name('removeProductImage');
        Route::get('/api/v1.0/products/remove/{id}', 'Secured\SecuredProductsController@removeProductAPI')->name('removeProductAPI');
        // Parts Constructor
        Route::post('/api/v1.0/constructor/init/save', 'Secured\SecuredPartsConstructor@saveConstructorInitAPI')->name('saveConstructorInitAPI');
        Route::post('/api/v1.0/constructor/init/build/save', 'Secured\SecuredPartsConstructor@saveConstructorBuilderAPI')->name('saveConstructorBuilderAPI');
        Route::post('/api/v1.0/constructor/init/build/clear', 'Secured\SecuredPartsConstructor@clearConstructorBuilderAPI')->name('clearConstructorBuilderAPI');
        // Slider
        Route::post('/api/v1.0/slider/save', 'Secured\SecuredCommonController@saveNewSlideAPI')->name('saveNewSlideAPI');
        Route::post('/api/v1.0/slider/update', 'Secured\SecuredCommonController@updateSlideAPI')->name('updateSlideAPI');
        // Pages
        Route::post('/api/v1.0/pages/update', 'Secured\SecuredCommonController@updatePageItemAPI')->name('updatePageItemAPI');
        Route::post('/api/v1.0/pages/home/update', 'Secured\SecuredCommonController@updateHomePageItemAPI')->name('updateHomePageItemAPI');
        //News
        Route::post('/api/v1.0/news/save', 'Secured\SecuredCommonController@saveNewNewsItemAPI')->name('saveNewNewsItemAPI');
        Route::post('/api/v1.0/news/update', 'Secured\SecuredCommonController@updateNewsItemAPI')->name('updateNewsItemAPI');
        // Upload
        Route::post('/api/v1.0/upload/csv/equipments', 'Secured\SecuredPagesController@uploadEquipmentsCsvApi')->name('uploadEquipmentsCsvApi');
        Route::post('/api/v1.0/upload/csv/parts', 'Secured\SecuredPagesController@uploadPartsCsvApi')->name('uploadPartsCsvApi');
    });
});
