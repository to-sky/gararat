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
        ########################################################################
        # API
        ########################################################################

    });
});