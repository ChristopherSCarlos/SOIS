<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Frontpage;
use App\Http\Livewire\OrganizationMenus;
use App\Http\Livewire\EventController;

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

Route::group(['middleware' => [
            'auth:sanctum',
            'verified',
]], function(){
        Route::get('/dashboard', function(){
            return view('dashboard');
        })->name('dashboard');
        
        Route::get('/pages', function(){
            return view('admin.pages');
        })->name('pages');

        Route::get('/navigation-menus', function(){
            return view('admin.navigation-menu');
        })->name('navigation-menus');

        Route::get('/organization-menus', function(){
            return view('admin.organization');
        })->name('organization-menus');

        Route::get('/users', function(){
            return view('admin.users');
        })->name('users');

        Route::get('/user-permissions', function(){
            return view('admin.user-permission');
        })->name('user-permissions');

        Route::get('/default-interface', function(){
            return view('admin.default-interface');
        })->name('default-interface');

        Route::get('/articles', function(){
            return view('admin.articles');
        })->name('articles');


            Route::post('file-upload', [ OrganizationMenus::class, 'fileUploadPost' ])->name('file.upload.post');
            Route::get('createOrg', [ OrganizationMenus::class, 'createOrg' ])->name('createOrg');

});




Route::get('/{urlslug}', FrontPage::class);
Route::get('/student-organization-information-system', FrontPage::class);
