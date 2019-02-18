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
    return redirect()->route('homePage');
})->name('home');
//======================================================================
// WEBSITE
//======================================================================
########################################################################
# Public routes
########################################################################
Route::get('/', 'Website\PagesController@homePage')->name('homePage');
// Catalog
Route::get('/catalog/{cat_number}', 'Website\CatalogController@catalogPage')->name('catalogPage');
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
        // Catalog
        Route::get('/secured/admin/catalog', 'Secured\SecuredCatalogController@securedCatalogListPage')->name('securedCatalogListPage');
        Route::get('/secured/admin/catalog/add', 'Secured\SecuredCatalogController@securedAddCatalogItemPage')->name('securedAddCatalogItemPage');
        Route::get('/secured/admin/catalog/edit/{cid}', 'Secured\SecuredCatalogController@securedEditCatalogItemPage')->name('securedEditCatalogItemPage');
        Route::get('/secured/admin/catalog/delete/{cid}', 'Secured\SecuredCatalogController@securedDeleteCatalogItemPage')->name('securedDeleteCatalogItemPage');
        // Products
        ########################################################################
        # API
        ########################################################################
        // Catalog
        Route::post('/api/v1.0/catalog/new/save', 'Secured\SecuredCatalogController@saveNewCatalogItemAPI')->name('saveNewCatalogItemAPI');
        Route::post('/api/v1.0/catalog/edit/update', 'Secured\SecuredCatalogController@updateCatalogItemAPI')->name('updateCatalogItemAPI');
    });
});
