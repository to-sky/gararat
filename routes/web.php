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
    Route::get('/node/{nid}', 'Website\NodesController@singleNodePage')->name('singleNodePage');
    // Cart
    Route::get('/cart', 'Website\OrdersController@cartPage')->name('cartPage');
    Route::get('/cart/checkout', 'Website\OrdersController@cartPage')->name('cartPage');
    Route::get('/cart/checkout/proceed', 'Website\OrdersController@cartProceedPage')->name('cartProceedPage');
    Route::get('/cart/checkout/success/{oid}', 'Website\OrdersController@cartProceedSuccessPage')->name('cartProceedSuccessPage');
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
        Route::get('/secured/admin', 'Secured\SecuredPagesController@securedDashboardPage')->name('securedDashboardPage');
        Route::get('/secured/admin/search', 'Secured\SecuredPagesController@securedSearchPage')->name('securedSearchPage');
        // Orders
        Route::get('/secured/admin/orders', 'Secured\SecuredOrdersController@ordersListPageSecured')->name('ordersListPageSecured');
        Route::get('/secured/admin/orders/{oid}', 'Secured\SecuredOrdersController@reviewOrderPageSecured')->name('reviewOrderPageSecured');
        // Catalog
        Route::get('/secured/admin/catalog', 'Secured\SecuredCatalogController@securedCatalogListPage')->name('securedCatalogListPage');
        Route::get('/secured/admin/catalog/add', 'Secured\SecuredCatalogController@securedAddCatalogItemPage')->name('securedAddCatalogItemPage');
        Route::get('/secured/admin/catalog/edit/{cid}', 'Secured\SecuredCatalogController@securedEditCatalogItemPage')->name('securedEditCatalogItemPage');
        Route::get('/secured/admin/catalog/delete/{cid}', 'Secured\SecuredCatalogController@securedDeleteCatalogItemPage')->name('securedDeleteCatalogItemPage');
        // Products
        Route::get('/secured/admin/products/sections/{product_type}', 'Secured\SecuredProductsController@productsListSecuredPage')->name('productsListSecuredPage');
        Route::get('/secured/admin/products/{product_type}/add', 'Secured\SecuredProductsController@addNewProduct')->name('addNewProduct');
        Route::get('/secured/admin/products/{product_type}/add', 'Secured\SecuredProductsController@addNewProduct')->name('addNewProduct');
        Route::get('/secured/admin/products/{product_type}/{nid}/actions/edit', 'Secured\SecuredProductsController@editNode')->name('editNode');
        Route::get('/secured/admin/products/{nid}/actions/delete', 'Secured\SecuredProductsController@deleteNode')->name('deleteNode');
        // Parts Constructor
        Route::get('/secured/admin/constructor/list', 'Secured\SecuredPartsConstructor@listConstructorPage')->name('listConstructorPage');
        Route::get('/secured/admin/constructor/add/init', 'Secured\SecuredPartsConstructor@initNewConstructorDrawingPage')->name('initNewConstructorDrawingPage');
        Route::get('/secured/admin/constructor/add/create/{fig_id}', 'Secured\SecuredPartsConstructor@createNewConstructorDrawingPage')->name('createNewConstructorDrawingPage');
        Route::get('/secured/admin/constructor/add/delete/{fig_id}', 'Secured\SecuredPartsConstructor@deleteConstructorDrawingPage')->name('deleteConstructorDrawingPage');
        // Slider
        Route::get('/secured/admin/slider', 'Secured\SecuredCommonController@securedSlidesPage')->name('securedSlidesPage');
        Route::get('/secured/admin/slider/add', 'Secured\SecuredCommonController@securedAddSlidePage')->name('securedAddSlidePage');
        Route::get('/secured/admin/slider/remove/{sl_id}', 'Secured\SecuredCommonController@securedRemoveSlide')->name('securedRemoveSlide');
        // News
        Route::get('/secured/admin/news', 'Secured\SecuredCommonController@securedNewsListPage')->name('securedNewsListPage');
        Route::get('/secured/admin/news/add', 'Secured\SecuredCommonController@securedAddNewNewsItem')->name('securedAddNewNewsItem');
        Route::get('/secured/admin/news/edit/{nw_id}', 'Secured\SecuredCommonController@securedUpdateNewsItem')->name('securedUpdateNewsItem');
        Route::get('/secured/admin/news/remove/{nw_id}', 'Secured\SecuredCommonController@securedRemoveNewsItem')->name('securedRemoveNewsItem');
        // Pages
        Route::get('/secured/admin/pages', 'Secured\SecuredCommonController@securedPagesListPage')->name('securedPagesListPage');
        Route::get('/secured/admin/pages/edit/home', 'Secured\SecuredCommonController@securedHomePageEditPage')->name('securedHomePageEditPage');
        Route::get('/secured/admin/pages/edit/services', 'Secured\SecuredCommonController@securedServicesPageEditPage')->name('securedServicesPageEditPage');
        Route::get('/secured/admin/pages/edit/contacts', 'Secured\SecuredCommonController@securedContactsPageEditPage')->name('securedContactsPageEditPage');

        // Upload
        Route::get('/secured/admin/upload/csv', 'Secured\SecuredPagesController@uploadCSVPage')->name('uploadCSVPage');
        ########################################################################
        # API
        ########################################################################
        // Orders
        Route::post('/api/v1.0/orders/change/status', 'Secured\SecuredOrdersController@changeOrderStatusAPI')->name('changeOrderStatusAPI');
        Route::get('/api/v1.0/orders/change/products/{oid}/{nid}', 'Secured\SecuredOrdersController@removeProductFromOrderAPI')->name('removeProductFromOrderAPI');
        Route::get('/api/v1.0/orders/change/delete/{oid}', 'Secured\SecuredOrdersController@removeOrderAPI')->name('removeOrderAPI');
        // Catalog
        Route::post('/api/v1.0/catalog/new/save', 'Secured\SecuredCatalogController@saveNewCatalogItemAPI')->name('saveNewCatalogItemAPI');
        Route::post('/api/v1.0/catalog/edit/update', 'Secured\SecuredCatalogController@updateCatalogItemAPI')->name('updateCatalogItemAPI');
        // Products
        Route::post('/api/v1.0/products/equipment/save', 'Secured\SecuredProductsController@saveNewEquipmentAPI')->name('saveNewEquipmentAPI');
        Route::post('/api/v1.0/products/equipment/update', 'Secured\SecuredProductsController@updateEquipmentAPI')->name('updateEquipmentAPI');
        Route::post('/api/v1.0/products/parts/save', 'Secured\SecuredProductsController@saveNewPartsAPI')->name('saveNewPartsAPI');
        Route::post('/api/v1.0/products/parts/update', 'Secured\SecuredProductsController@updatePartsAPI')->name('updatePartsAPI');
        Route::get('/api/v1.0/products/images/remove/{ni_id}', 'Secured\SecuredProductsController@removeProductImage')->name('removeProductImage');
        Route::get('/api/v1.0/products/remove/{nid}', 'Secured\SecuredProductsController@removeProductAPI')->name('removeProductAPI');
        // Parts Constructor
        Route::post('/api/v1.0/constructor/init/save', 'Secured\SecuredPartsConstructor@saveConstructorInitAPI')->name('saveConstructorInitAPI');
        Route::post('/api/v1.0/constructor/init/build/save', 'Secured\SecuredPartsConstructor@saveConstructorBuilderAPI')->name('saveConstructorBuilderAPI');
        Route::post('/api/v1.0/constructor/init/build/clear', 'Secured\SecuredPartsConstructor@clearConstructorBuilderAPI')->name('clearConstructorBuilderAPI');
        // Slider
        Route::post('/api/v1.0/slider/save', 'Secured\SecuredCommonController@saveNewSlideAPI')->name('saveNewSlideAPI');
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
