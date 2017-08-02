<?php

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

use App\Container\Users\Src\User;



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

/*
 * Rutas de Ejemplo
 *
 * Las siguientes rutas son sólo de muestras
 * y documentación de los componentes que se van a usar
 * para el desarrollo del proyecto.
 *
 * Deben ser elminadas al iniciar con el desarrollo
 * del proyecto
 */

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', function () {
        return view('material.sample');
    })->name('root');

    Route::group(['prefix' => 'components'], function () {
        //Submenu 1
        Route::get('buttons', function ()    {
            return view('examples.buttons');
        })->name('components.buttons');
        Route::get('icons', function ()    {
            return view('examples.icons');
        })->name('components.icons');

        Route::get('portlet', function ()    {
            return view('examples.portlet');
        })->name('components.portlet');

        Route::get('sidebar', function ()    {
            return view('examples.sidebar');
        })->name('components.sidebar');

        Route::get('datatables', function ()    {
            return view('examples.datatables');
        })->name('components.datatables');

        Route::get('datatables/index',[
            'as' => 'components.datatables.data',
            'uses' => function (Request $request)    {
            if($request->ajax()){
                return Datatables::of(User::all())
                    ->addIndexColumn()
                    ->make(true);
            }else{
                return response()->json([
                    'message' => 'Incorrect request',
                    'code' => 412
                ],412);
            }
        }]);

    });

    Route::group(['prefix' => 'forms'], function () {
        Route::get('dropzone', function ()    {
            return view('examples.dropzone');
        })->name('forms.dropzone');

        Route::post('dropzone/store',function (Request $request)    {
            return $request->get('name');
            $files = $request->file('file');
            foreach($files as $file){
                $url = Storage::disk('developer')->putFile('avatars', $file);
            }
        })->name('forms.dropzone.store');

        Route::get('fields', function ()    {
            return view('examples.fields');
        })->name('forms.fields');
        Route::get('validation', function ()    {
            return view('examples.validation');
        })->name('forms.validation');
    });

    Route::group(['prefix' => 'permissions'], function () {
        $controller = "\\App\\Container\\Permissions\\Src\\Controllers\\";
        Route::get('index',[
            'uses' => $controller.'PermissionController@index',
            'as' => 'permissions.index'
        ]);
        Route::get('data',[
            'uses' => $controller.'PermissionController@data',
            'as' => 'permissions.data'
        ]);

        Route::get('edit/{id?}',[
            'uses' => $controller.'PermissionController@edit',
            'as' => 'permissions.edit'
        ])->where(['id' => '[0-9]+']);

        Route::post('store',[
            'uses' => $controller.'PermissionController@store',
            'as' => 'permissions.store'
        ]);
        Route::post('update/{id?}',[
            'uses' => $controller.'PermissionController@update',
            'as' => 'permissions.update'
        ])->where(['id' => '[0-9]+']);
        Route::delete('delete/{id?}',[
            'uses' => $controller.'PermissionController@destroy',
            'as' => 'permissions.destroy'
        ])->where(['id' => '[0-9]+']);
    });

    Route::group(['prefix' => 'roles'], function () {
        $controller = "\\App\\Container\\Permissions\\Src\\Controllers\\";
        Route::get('index',[
            'uses' => $controller.'RoleController@index',
            'as' => 'roles.index'
        ]);
        Route::get('data',[
            'uses' => $controller.'RoleController@data',
            'as' => 'roles.data'
        ]);
        Route::post('store',[
            'uses' => $controller.'RoleController@store',
            'as' => 'roles.store'
        ]);
        Route::post('update/{id?}',[
            'uses' => $controller.'RoleController@update',
            'as' => 'roles.update'
        ])->where(['id' => '[0-9]+']);
        Route::delete('delete/{id?}',[
            'uses' => $controller.'RoleController@destroy',
            'as' => 'roles.destroy'
        ])->where(['id' => '[0-9]+']);
    });

    Route::group(['prefix' => 'modules'], function () {
        $controller = "\\App\\Container\\Permissions\\Src\\Controllers\\";
        Route::get('index',[
            'uses' => $controller.'ModuleController@index',
            'as' => 'modules.index'
        ]);
        Route::get('data',[
            'uses' => $controller.'ModuleController@data',
            'as' => 'modules.data'
        ]);
        Route::post('store',[
            'uses' => $controller.'ModuleController@store',
            'as' => 'modules.store'
        ]);
        Route::post('update/{id?}',[
            'uses' => $controller.'ModuleController@update',
            'as' => 'modules.update'
        ])->where(['id' => '[0-9]+']);
        Route::delete('delete/{id?}',[
            'uses' => $controller.'ModuleController@destroy',
            'as' => 'modules.destroy'
        ])->where(['id' => '[0-9]+']);
    });

    Route::group(['prefix' => 'role/permission'], function () {
        $controller = "\\App\\Container\\Permissions\\Src\\Controllers\\";
        Route::get('index',[
            'uses' => $controller.'RolePermissionController@index',
            'as' => 'roles.permission.index'
        ]);
        Route::get('data/role/{id?}',[
            'uses' => $controller.'RolePermissionController@data',
            'as' => 'roles.permission.data'
        ]);
        Route::post('update/{id?}',[
            'uses' => $controller.'RolePermissionController@update',
            'as' => 'role.permission.update'
        ])->where(['id' => '[0-9]+']);
    });

    Route::group(['prefix' => 'users'], function () {
        $controller = "\\App\\Container\\Users\\Src\\Controllers\\";
        Route::get('index',[
            'uses' => $controller.'UserController@index',
            'as' => 'users.index'
        ]);
        Route::get('index/ajax',[
            'uses' => $controller.'UserController@index_ajax',
            'as' => 'users.index.ajax'
        ]);
        Route::get('create',[
            'uses' => $controller.'UserController@create',
            'as' => 'users.create'
        ]);
        Route::get('edit/{id?}',[
            'uses' => $controller.'UserController@edit',
            'as' => 'users.edit'
        ]);
        Route::get('data',[
            'uses' => $controller.'UserController@data',
            'as' => 'users.data'
        ]);
        Route::post('store',[
            'uses' => $controller.'UserController@store',
            'as' => 'users.store'
        ]);
        Route::post('update/{id?}',[
            'uses' => $controller.'UserController@update',
            'as' => 'users.update'
        ])->where(['id' => '[0-9]+']);
        Route::delete('delete/{id?}',[
            'uses' => $controller.'UserController@destroy',
            'as' => 'users.destroy'
        ])->where(['id' => '[0-9]+']);
    });

    Route::group(['prefix' => 'location'], function () {
        $controller = "\\App\\Container\\Users\\Src\\Controllers\\";
        Route::get('countries',[
            'uses' => $controller.'LocationController@to_list_countries',
            'as' => 'location.countries'
        ]);
        Route::get('regions/find/country/{id?}',[
            'uses' => $controller.'LocationController@to_list_regions_find',
            'as' => 'location.regions.find'
        ]);
        Route::get('cities/find/country/{id_region?}/{id_city?}',[
            'uses' => $controller.'LocationController@to_list_cities_find',
            'as' => 'location.cities.find'
        ]);
    });
});





/*
 * Fin de las rutas de ejemplo.
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
