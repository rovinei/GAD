<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
/*Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');*/

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::group(['middleware' =>'locale'],function(){

    Route::get('/', function(){
        $sliders = \App\Slider::where('type','SLIDE SHOW')->get();
        $clients = \App\Slider::where('type','CLIENT SHOW')->get();
        $services = \App\Slider::where('type','SERVICE SHOW')->get();
        $contents = \App\Content::where('show_home_page',1)->get();
        return view('home')->with([
            'sliders' => $sliders,
            'clients' => $clients,
            'services' => $services,
            'projects' => $contents,
            'menu' => \App\Menu::first()
        ]);
    });
    
    Route::get('/menu/{menuId}', function($menuId){
        $data["sidebar_menu"] = \App\Menu::find($menuId);
        return response()->json($data);
    });
    
    Route::get('/about_us', function(){
       return view('about_us')->with([
            'menu' => \App\Menu::whereRaw("UPPER(title)='ABOUT US'")->whereNull('deleted_at')->first(),
/*            'sidebar_menus' => \App\Menu::where('status',1)
                                         //->whereRaw("UPPER(title)='ABOUT US'")
                                         //->whereNull('deleted_at')
                                         ->where('position',0)
                                         ->orderBy('ordering')
                                         ->get()*/
       ]); 
    });
    
    Route::get('/contact', function(){
       return view('contact')->with([
            'menu' => \App\Menu::whereRaw("UPPER(title)='CONTACT'")->first()     
       ]);
    });
    
    Route::get('/projects', function(){
       return view('project_list') ;
    });
    
    Route::get('/projectsinfo', function(){
       return view('project_info') ;
    });
    Route::get('/about', function(){
       return view('about') ;
    });
    
    Route::get('/home', function(){
        return view('welcome');
    });
    Route::get('menu/{menuId}/categories/{categoryId}/projects/{projectId?}',function($menuId, $categoryId, $projectId=''){
        $menu = \App\Menu::find($menuId);
        $category = \App\Category::find($categoryId);

        $categories = \App\Category::where('level','1')
                               ->where('parent_id',$menu->internal_url)
                               ->whereNull('deleted_at')
                               ->orderBy('ordering')->get();
 
        if($projectId==''){
            $parentCategory = \App\Category::where('parent_id',$categoryId)
                                           ->orWhereIn('parent_id',DB::table('categories')->where('parent_id',$categoryId)->whereNull('deleted_at')->lists('id'))
                                           ->whereNull('deleted_at')
                                           ->lists('id');
            $parentCategorySup = \App\Category::whereNull('deleted_at')->where('parent_id','in',(implode(' ,',$parentCategory->toArray())))->lists('id');
            $contents = \App\Content::where('category_id',$categoryId)
                                    ->orWhereIn('category_id', $parentCategory->toArray())
                                    ->whereNull('deleted_at')
                                    ->orderBy('created_at')
                                    ->paginate(21);
            return view('project_list')->with([
                'category' => $category,
                'categories' => $categories,
                'contents' => $contents,
                'menu' => $menu
            ]);
        }else{
            $content = \App\Content::find($projectId);
            return view('project_info')->with([
                'category' => $category,
                'categories' => $categories,
                'content' => $content,
                'menu' => $menu
            ]);
        }
    })->where(['menuId' => '[0-9]+', 
               'categoryId' => '[0-9]+',
               'projectId' => '[0-9]+']);
    Route::get('categories/projects/search', 'CategoryController@search');
    Route::post('menu/{menuId}/categories/{categoryId}/projects',function($menuId,$categoryId){
        $parentCategory = \App\Category::where('parent_id',$categoryId)
                                           ->orWhereIn('parent_id',DB::table('categories')->where('parent_id',$categoryId)->lists('id'))
                                           ->whereNull('deleted_at')
                                           ->lists('id');
        $contents = \App\Content::where('category_id',$categoryId)
                                ->orWhereIn('category_id', $parentCategory->toArray())
                                ->whereNull('deleted_at')
                                ->orderBy('created_at')
                                ->paginate(21);
        $data = View('project_list_template')->with([
                    'contents' => $contents,
                    'menu' => \App\Menu::find($menuId)
                ])->render();
        return response()->json($data);
    });
    
    Route::get('locale/{locale?}',[
        'as' => 'locale.setocale',
        'uses' => 'LocaleController@setLocale'
    ]);
});


Route::get('/admin/login', function () {
    return view('login');
});

Route::get('admin/users/change_password',[
    'middleware' => ['auth'],
    'uses' => 'Admin\UserController@changePassword'
]);

Route::get('admin',[
    'middleware' => ['auth'],
    'uses' => 'Admin\DashboardController@Index'
]);

Route::get('admin/dashboard',[
    'middleware' => ['auth'],
    'uses' => 'Admin\DashboardController@Index'
]);

Route::group(['prefix' => 'admin'
            , 'namespace' => 'Admin'
            , 'middleware' =>'auth'],function(){
                
    Route::post('categories/updatecategory','CategoryController@UpdateCategory');
    Route::post('categories/translation','CategoryController@Translation');
    Route::resource('categories','CategoryController');  
    
    Route::post('users/updateuser','UserController@UpdateUser');
    Route::post('users/changepassword','UserController@ChangePassword');
    Route::resource('users','UserController');
    
    Route::post('contents/updatecontent','ContentController@UpdateContent');
    Route::post('contents/translation','ContentController@Translation');
    Route::resource('contents', 'ContentController');
    
    Route::post('menus/updatemenu/{id}','MenuController@UpdateMenu');
    Route::post('menus/translation','MenuController@Translation');
    Route::resource('menus', 'MenuController');
    
    Route::resource('settings', 'SettingController');
    
    Route::resource('languages', 'LanguageController');
    
    Route::post('sliders/translation','SliderController@Translation');
    Route::post('sliders/updateslider/','SliderController@UpdateSlider');
    Route::resource('sliders', 'SliderController');
    
    Route::resource('images', 'ImageController');
    

});


Route::group(array('middleware' => 'auth'), function(){
    Route::controller('filemanager', 'FilemanagerLaravelController');
});

Route::get('/rest/contents', function(){
   return \App\Content::paginate(); 
});


Route::group(['prefix' => 'rest/admin'
            , 'namespace' => 'Admin'
            , 'middleware' =>'auth'],function(){
                
    Route::post('/contents', ['uses' => 'ContentController@Json']);
    Route::post('/contents/translate', ['uses' => 'ContentController@Translate']);
    
    Route::post('/menus', ['uses' => 'MenuController@Json']);
    Route::post('/menus/translate', ['uses' => 'MenuController@Translate']);

    Route::post('/categories', ['uses' => 'CategoryController@Json']);
    Route::post('/categories/translate', ['uses' => 'CategoryController@Translate']);
    
    Route::post('/users', ['uses' => 'UserController@Json']);
    
    Route::post('/sliders/translate', ['uses' => 'SliderController@Translate']);
    Route::post('/sliders', ['uses' => 'SliderController@Json']);
    
});

View::composer(['includes.header','includes.footer','app','home','includes.responsive'], function($view){
   $menus = \App\Menu::where('status',1)
                     ->whereNull('deleted_at')
                     ->where('position',1)
                     ->get();
   $view->with([
       'menus'=> $menus,
       'settings' => \App\Setting::first()
   ]);
});


Route::resource('emails', 'MailController');

/*Route::post('/sendemail',function(){
    Mail::send('admin.users.change_password_user', ['user' => Auth::user()], function($message) {
        $message->to('darapenhchet@gmail.com', 'DARA PENHCHET')->subject('GREEN ARCHITECURE AND DESIGN.');
    }); 
});*/
