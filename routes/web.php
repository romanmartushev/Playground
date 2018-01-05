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
Route::get('/homepage-birthdays','FamilyTree@getBirthdays');

Route::get('/family-tree','FamilyTree@viewTree');

Route::get('/add-member', 'FamilyTree@startCreate');
Route::get('/add-new-member','FamilyTree@createMember');

Route::get('/update-member', 'FamilyTree@startUpdate');
Route::get('/update-a-member','FamilyTree@updateMember');