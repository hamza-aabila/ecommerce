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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();


Route::prefix('admin/')->namespace('Admin')->group(function () {
    Route::get('login', 'AdministratorController@showLoginForm');
    Route::post('login', 'AdministratorController@login')->name('adminLogin');
    Route::get('dashboard', 'DashboardController@index');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products', 'ProductController');



Route::get('/cart', 'Cart\ShoppingCartController@show')->name('shopping_cart.show');
Route::get('/api/cart/products', 'Cart\ShoppingCartController@productsInCart');

Route::prefix('api')->namespace('Api')->group(function () {
    Route::get('products', 'ApiController@products');
    Route::get('products/{id}/prices', 'ApiController@product_prices');
    Route::get('productImages/{id}', 'ApiController@product_images');
    Route::post('product-image/{id}/delete', 'ApiController@destroy_product_images');
    Route::put('update/{id}/product-price-specifics/', 'ApiController@update_price_specifics');

});


/** API Feature */
Route::prefix('api')->namespace('Api')->group(function () {
    Route::get('features/get-features', 'ApiFeaturesController@features');
    Route::get('product/{id}/feature-details', 'ApiFeaturesController@feature_details');
});
/** API Feature */


/** API Category and Subcategory */
Route::prefix('api')->namespace('Api')->group(function () {
    Route::get('category/get-category', 'ApiCategoryController@categories');
    Route::get('subcategories/get-subcategory-product/{id}', 'ApiCategoryController@subcategories');
});
/** API Category and Subcategory */


/** API Attributes and AttributeDetails */
Route::prefix('api')->namespace('Api')->group(function () {
    Route::get('attributes', 'ApiAttributeController@attributes');
});
/** API Attributes and AttributeDetails */




Route::prefix('shopping_cart')->namespace('Cart')->group(function () {
    Route::post('/add', 'ProductInCartController@store');
    Route::post('/decrement', 'ProductInCartController@decrement');
});


Route::prefix('admin')->namespace('Admin')->group(function () {
    /** Products */
    Route::get('/products', 'ProductController@index')->name('product.index');
    Route::get('/products/create', 'ProductController@create')->name('product.create');
    Route::post('/products/create', 'ProductController@store')->name('product.store');
    Route::get('/products/{id}/edit', 'ProductController@edit')->name('product.edit');
    Route::put('/products/{id}/update', 'ProductController@update')->name('product.update');
    /** endProducts */

    /** Categories */
    Route::get('/categories', 'CategoryController@index')->name('category.index');
    Route::get('/categories/create', 'CategoryController@create')->name('category.create');
    Route::post('/categories/create', 'CategoryController@store')->name('category.store');
    Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('category.edit');
    Route::put('/categories/{id}/update', 'CategoryController@update')->name('category.update');
    Route::post('/categories/change-status', 'CategoryController@changeStatus');
    /** endCategories */


    /** SubCategories */
    Route::get('/subcategories/create', 'SubcategoryController@create')->name('subcategory.create');
    Route::post('/subcategories/create', 'SubcategoryController@store')->name('subcategory.store');
    Route::get('/subcategories/{id}', 'SubcategoryController@show')->name('subcategory.show');
    Route::get('/subcategories/{id}/edit', 'SubcategoryController@edit')->name('subcategory.edit');
    Route::put('/subcategories/{id}/edit', 'SubcategoryController@update')->name('subcategory.update');
    Route::post('/subcategories/change-status', 'SubcategoryController@changeStatus');


    /** endSubCategories */

    /** Featrue */
    Route::resource('/features', 'FeatureController');
    Route::resource('/features-details', 'FeatureDetailController');
    /** endFeacture */

    /** Attribute */
    Route::resource('/attributes', 'AttributeController');
    Route::resource('/attributes-details', 'AttributeDetailController');
    /** endAttribute */

    /** Supplier */
    Route::resource('/suppliers', 'SupplierController');
    /** endsupplier */
});
