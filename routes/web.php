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

Route::group(['middleware' => ['auth']], function(){ 

    Route::get('/', 'HomeController@index');

    Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
        Route::resource('works', 'Work\WorkController')->parameters([
            'works' => 'wdx'
        ]);

        Route::post('works/uid', 'Work\WorkController@getUid')->name('works.getuid');

        Route::resource('layouts', 'Layout\LayoutController')->parameters([
            'layouts' => 'lodx'
        ]);

        Route::resource('layout-tops', 'Layout\LayoutTopController')->parameters([
            'layout-tops' => 'lotdx'
        ]);

        Route::resource('layout-navigations', 'Layout\LayoutNaviController')->parameters([
            'layout-navigations' => 'londx'
        ]);

        Route::resource('layout-middles', 'Layout\LayoutMiddleController')->parameters([
            'layout-middles' => 'lomdx'
        ]);

        Route::resource('layout-bottoms', 'Layout\LayoutBottomController')->parameters([
            'layout-bottoms' => 'lobdx'
        ]);

        Route::resource('layout-etcs', 'Layout\LayoutEtcController')->parameters([
            'layout-etcs' => 'loedx'
        ]);

        Route::resource('packs', 'Pack\PackController')->parameters([
            'packs' => 'pdx'
        ]);
    });
});

