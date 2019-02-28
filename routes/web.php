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
// Catalog
Route::get('/catalog/{cid}', 'Website\CatalogController@catalogPage')->name('catalogPage');
// Nodes
Route::get('/node/{nid}', 'Website\NodesController@singleNodePage')->name('singleNodePage');
// Cart
Route::get('/cart', 'Website\OrdersController@cartPage')->name('cartPage');
Route::get('/cart/checkout', 'Website\OrdersController@cartPage')->name('cartPage');
Route::get('/cart/checkout/proceed', 'Website\OrdersController@cartProceedPage')->name('cartProceedPage');
Route::get('/cart/checkout/success/{oid}', 'Website\OrdersController@cartProceedSuccessPage')->name('cartProceedSuccessPage');
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
    });
});
