<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Address;

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

/*
 *      Doing some CRUD with Laravel using a One to One relationship
 */

Route::get('/insertdata',function() {
    DB::insert('insert into users(name, email, password) values(?,?,?)',['adam','adam@test.com','123']);

});

Route::get('/insert', function () {
    $user = User::findOrFail(1);

    $address = new Address(['name'=>'12408 N Rome Tampa FL 33612']);

    // echo $address;

    $user->address()->save($address);
});

Route::get('/update', function() {
    // whereUserId() will get an id from the user
    // if more than one record, this will update all other records
    // need to put a second where or if statement for specificity
    $address = Address::whereUserId(1)->first();

    $address->name = "333 Updated Ave, Tampa FL 33612";

    $address->save();

});

Route::get('/read', function() {
    $user = User::findOrFail(1);

    echo $user->address->name;
});

Route::get('/delete', function() {
    $user = User::findOrFail(1);

    $user->address()->delete();

    return "done";
});