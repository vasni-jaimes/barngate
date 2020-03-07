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

// Route::get('/', function () {
//     return view('welcome');
// });


//Vistas Estaticas
Route::view('/about', 'site.about')->name('about');
Route::view('/contact', 'site.contact')->name('contact');


//Vistas Dinamicas
Route::get('/', 'HomeController@index')->name("home");

//Login, Logout, Register
Auth::routes(["register" => false]);
Route::post('/register', 'UsersController@createRegistro')->name('registro.create');
Route::post('/ajaxLogin', 'UsersController@ajaxLogin')->name('ajaxLogin');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//Sale
Route::get('/sale', 'SaleController@create')->name('sale');
Route::post('/sale.store', 'SaleController@store')->name('sale.store');
Route::post('/searchState', 'SaleController@SearchState')->name('sale.state');
Route::post('/animal_config', 'SaleController@SearchAnimal')->name('search.animal');
Route::get('/plan/{id}', 'SaleController@updatePlan')->name('sale.updateplan');
Route::post('/update/plan/{id}', 'SaleController@PageUpdatePlan')->name('sale.pageupdateplan');

//Myaccount
Route::get('/myaccount', 'MyaccountController@index')->name('myaccount');
Route::post('/myaccount/editProfile', 'MyaccountController@EditProfile')->name('editprofile');
Route::post('/saveSettings', 'MyaccountController@SaveSettings')->name('SaveSettings');
Route::post('saveImgMyaccount', 'MyaccountController@SaveImgMyaccount')->name('saveimgmyaccount');
Route::post('/myaccount/removeAnimal', 'MyaccountController@removeAnimal')->name('RemoveAnimal');

//Detalle
Route::get('/detail/{id}', 'SaleController@show')->name('sale.show');

//Favorites
Route::post("/addFavorite", "FavoritesController@addFavorite")->name("addFav");

//Search
Route::get('/search', 'SearchController@VistaSearch')->name('vistaSearch');
Route::post('/searcha', 'SearchController@SerchAjax')->name('serchajax');

//Contact
Route::post('/contact_send', 'HomeController@ContactSend')->name('contact.send');


//Chat
Route::get('/chat/{user_id}', 'ChatController@index')->name('chat.index');
Route::post('/messageSend', 'ChatController@messagesChat')->name("message.send");


//Vistas estaticas
Route::view('/faqs', 'site.faqs')->name('faqs');
Route::view('/privacy', 'site.privacy')->name('privacy');
Route::view('/notifications', 'site.notifications')->name('notifications');
//Route::view('/chat', 'site.chat')->name('chat');
Route::view('/reset', 'site.reset')->name('reset');
Route::view('/edit_animal', 'site.edit_animal')->name('edit_animal');
//Route::view('/vista', 'site.vista')->name('vista');
