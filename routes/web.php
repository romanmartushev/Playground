<?php
use Illuminate\Support\Facades\Route;
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

Route::get('/family-tree',function(){
   return view('welcome');
});

Route::get('/add-member', 'FamilyTree@startCreate');
Route::post('/add-member','FamilyTree@createMember');

Route::get('/update-member', 'FamilyTree@startUpdate');
Route::post('/update-member','FamilyTree@updateMember');