<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuTranslation;
use App\Category;
use Auth;
use DB;
use Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Menu::all());
        $menus = DB::table('menus')->select('menus.*','parent.title As parent_title','users.email AS author','editor.email As editor',
                            DB::raw("(CASE menus.level 
                                      WHEN 0 THEN menus.ordering
                                      WHEN 1 THEN (SELECT CONCAT(m.ordering, '.' ,menus.ordering) FROM menus as m WHERE m.id=menus.parent_id)
                                      WHEN 2 THEN (SELECT CONCAT((SELECT super.ordering FROM menus AS super WHERE super.id = m.parent_id), '.' , m.ordering, '.' ,menus.ordering) FROM menus as m WHERE m.id=menus.parent_id)
                                      END) AS Pos"))
                            ->leftJoin('menus As parent', 'parent.id', '=', 'menus.parent_id')
                            ->leftJoin('users', 'users.id', '=', 'menus.created_by')
                            ->leftJoin('users AS editor', 'editor.id', '=', 'menus.updated_by')
                            ->whereNull('menus.deleted_at')
                            ->orderBy('Pos')
                            ->paginate(15);
        //print_r($menus);
        return View('admin.menus.menu')->with([
/*            'menus' => Menu::orderBy('parent_id','asc')
                           ->orderBy('level','asc')
                           ->orderBy('ordering', 'asc')
                           ->paginate(15)*/
              'menus' => $menus
        ]);
    }
    
    public function json(Request $requests){
        $limit = $requests->input('limit') ? $requests->input('limit') : 15;
        if($limit>100 || $limit<=0){
            $limit = 15;
        }
        
        $menus = DB::table('menus')->select('menus.*','parent.title As parent_title','users.email AS author','editor.email As editor',
                            DB::raw("(CASE menus.level 
                                      WHEN 0 THEN menus.ordering
                                      WHEN 1 THEN (SELECT CONCAT(m.ordering, '.' ,menus.ordering) FROM menus as m WHERE m.id=menus.parent_id)
                                      WHEN 2 THEN (SELECT CONCAT((SELECT super.ordering FROM menus AS super WHERE super.id = m.parent_id), '.' , m.ordering, '.' ,menus.ordering) FROM menus as m WHERE m.id=menus.parent_id)
                                      END) AS Pos"))
                            ->leftJoin('menus As parent', 'parent.id', '=', 'menus.parent_id')
                            ->leftJoin('users', 'users.id', '=', 'menus.created_by')
                            ->leftJoin('users AS editor', 'editor.id', '=', 'menus.updated_by')
                            ->where('menus.title', 'like','%'.$requests->input('search').'%')
                            ->whereNull('menus.deleted_at')
                            ->orderBy('Pos')
                            ->paginate($limit);
        
        /*$menus = Menu::where('title', 'like','%'.$requests->input('search').'%')
                     ->orderBy('parent_id','asc')
                     ->orderBy('level','asc')
                     ->orderBy('ordering', 'asc')
                     ->paginate($limit);*/
        $data = View('admin.menus.menu_template')->with('menus', $menus)->render();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->select('categories.id','categories.title','categories.level',
                            DB::raw("(CASE categories.level 
                                      WHEN 0 THEN LPAD(categories.ordering,5,0)
                                      WHEN 1 THEN (SELECT CONCAT(LPAD(m.ordering,5,0), '.' ,LPAD(categories.ordering,5,0)) FROM categories as m WHERE m.id=categories.parent_id)
                                      WHEN 2 THEN (SELECT CONCAT((SELECT LPAD(super.ordering,5,0) FROM categories AS super WHERE super.id = m.parent_id), '.' , LPAD(m.ordering,5,0), '.' ,LPAD(categories.ordering,5,0)) FROM categories as m WHERE m.id=categories.parent_id)
                                      END) AS Pos"))
                      ->where('status',1)
                      ->whereNull('deleted_at')
                      ->orderBy('Pos')
                      ->get();
        return View('admin.menus.create_menu')->with([
            'menus' => Menu::where('level','<','2')
                                    ->where('status', 1)
                                    ->whereNull('deleted_at')
                                    ->get(),
            'categories' => $categories//Category::where('status',1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request){
            //1. Validation 
            $this->validate($request, [
                'title' => 'required|unique:menu_translations',
                'position' => 'required',
                'type' => 'required',
                'status' => 'required',
                'parent_id' => 'numeric',
                'ordering' => 'required|numeric'
            ]);
            
            //2. GET ALL REQUESTS AND CREATE MENU OBJECT
            $input = $request->all();
            if($request->input('parent_id')==''){
                $input = $request->except('parent_id');
            }else{
                $menuParent = Menu::find($request->input('parent_id'));
                $input['level'] = (++$menuParent->level);
            }
            $menu = new Menu($input);
    
            //3. SET CREATED USER TO THE MENU
            $menu->updatedBy()->associate(Auth::user());
            $menu->createdby()->associate(Auth::user());
    
            //4. SAVE MENU
            $menu->save();
            
            //$menuTranslations = new MenuTranslation($request->all());
            
            //$menu->menuTranslation()->save($menuTranslations);
    
            
            //3. INSERT INTO MENUS TABLE
            //Menu::create($input);
            //Menu::fill($input)->save();
            
            //5. FLASH MESSAGE BACK
            Session::flash('flash_message', 'Menu successfully added!');
            
            //6. REDIRECT BACK
        });
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return View('admin.menus.translate_menu')->with([
            'languages' => \App\Language::where([
                                            'status' => 1,
                                            'is_default' => false])->get(),
            'menu' => $menu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $categories = DB::table('categories')->select('categories.id','categories.title','categories.level',
                            DB::raw("(CASE categories.level 
                                      WHEN 0 THEN LPAD(categories.ordering,5,0)
                                      WHEN 1 THEN (SELECT CONCAT(LPAD(m.ordering,5,0), '.' ,LPAD(categories.ordering,5,0)) FROM categories as m WHERE m.id=categories.parent_id)
                                      WHEN 2 THEN (SELECT CONCAT((SELECT LPAD(super.ordering,5,0) FROM categories AS super WHERE super.id = m.parent_id), '.' , LPAD(m.ordering,5,0), '.' ,LPAD(categories.ordering,5,0)) FROM categories as m WHERE m.id=categories.parent_id)
                                      END) AS Pos"))
                      ->where('status',1)
                      ->whereNull('deleted_at')
                      ->orderBy('Pos')
                      ->get();
        return View('admin.menus.update_menu')->with([
            'menus' => Menu::where('level','<','2')
                           ->where('status', 1)
                           ->where('id','<>',$id)
                           ->get(),
            'categories' => $categories,
            'menu' => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }
    public function updateMenu(Request $request, $id)
    {

        /*DB::transaction(function () use ($request){
            //1. CHECKING VALIDATION
            $this->validate($request, [
                'title' => 'required',
                'position' => 'required',
                'type' => 'required',
                'status' => 'required',
                'menu_id' => 'required'
            ]);
            
            //2. GET ALL REQUESTS AND CREATE MENU OBJECT
            $input = $request->except('_token','menu_id');
            if($request->input('parent_id')==''){
                $input = $request->except('parent_id','_token','menu_id');
            }
    
            //3. GET MENU
            $menu = Menu::where([
                'id'=> $request->input('menu_id'),
                'status' => 1
            ])->firstOrFail();
            
            //4. CHECK MENU
            if($menu!=null){
                //5. GET MENU TRANSLATION
                $menuTranslations = MenuTranslation::where([
                        'menu_id' => $request->input('menu_id'),
                        'language_id' => 'en'
                    ]);
                //6. CHECK MENU TRANSLATION
                if($menuTranslations==null){
                    
                }else{
                    //7. SET UPDATED USER TO THE MENU
                    $input['updated_by'] = Auth::user()->id;
                    //8. UPDATE MENU
                    $menu->update($input);
                    //9. UPDATE MENUTRANSLATIONS
                    $menuTranslations->update($request->only('title','content'));
                }
                //10. FLASH MESSAGE BACK
                Session::flash('flash_message', 'Menu successfully updated!');
            }else{
                //11. FLASH MESSAGE BACK
                Session::flash('flash_message', 'Menu not found!!!');
            }*/
            
        DB::transaction(function () use ($request){
            //1. CHECKING VALIDATION
            $this->validate($request, [
                'title' => 'required',
                'position' => 'required',
                'type' => 'required',
                'status' => 'required',
                'menu_id' => 'required',
                'parent_id' => 'numeric',
                'ordering' => 'required|numeric'
            ]);
            
            //2. GET ALL REQUESTS AND CREATE MENU OBJECT
            $input = $request->except('_token','menu_id');
            if($request->input('parent_id')==''){
                $input = $request->except('parent_id','_token','menu_id');
                $input['parent_id'] = NULL;
            }else{
                $menuParent = Menu::find($request->input('parent_id'));
                $input['level'] = (++$menuParent->level);
            }
    
            //3. GET MENU
            $menu = Menu::where([
                'id'=> $request->input('menu_id')
            ])->firstOrFail();
            
            //4. CHECK MENU
            if($menu!=null){
                //7. SET UPDATED USER TO THE MENU
                $input['updated_by'] = Auth::user()->id;
                //8. UPDATE MENU
                $menu->update($input);

                //10. FLASH MESSAGE BACK
                Session::flash('flash_message', 'Menu successfully updated!');
            }else{
                //11. FLASH MESSAGE BACK
                Session::flash('flash_message', 'Menu not found!!!');
            }
        });
        //12. REDIRECT BACK
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return response()->json([
            'STATUS' => true
        ]);
    }
    public function translate(Request $request){
        $validation = $this->validate($request, [
            'menu_id' => 'required|numeric',
            'language_id' => 'required|max:2',
        ]);
        $menuTranslation = MenuTranslation::firstOrNew($request->all());
        if($menuTranslation->exists){
            return response()->json([
               'DATA' => $menuTranslation
            ]);
        }else{
            return response()->json([
                'DATA' => null
            ]);
        }
    }
    
    public function translation(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'menu_id' => 'required|numeric',
            'language_id' => 'required|max:2',
        ]);
        //2. Find menu by id
        $menu = Menu::firstOrNew([
            'id'=> $request->input('menu_id')/*,
            'status' => 1*/
        ]);
        
        try{
            if($menu->exists){
                $menuTranslation = MenuTranslation::firstOrNew($request->only('menu_id','language_id'));
                if(!$menuTranslation->exists){
                    $menuTranslation = new MenuTranslation($request->all());
                    $menuTranslation->save();
                    //5. FLASH MESSAGE BACK
                    Session::flash('flash_message', 'Menu successfully translated!');
                }else{
                    $menuTranslation::where('menu_id', $request->input('menu_id'))
                                       ->where('language_id', $request->input('language_id'))
                                       ->update($request->only('content','title'));
                    //5. FLASH MESSAGE BACK
                    Session::flash('flash_message', 'Menu successfully translate updated!');
                }
            }else{
                //5. FLASH MESSAGE BACK
                Session::flash('flash_message', 'Menu not found!!!');
            }
        }catch(Exception $e){
            
        }

        //6. REDIRECT BACK
        return redirect()->back();
        /*//1. Validation 
        $this->validate($request, [
            'title' => 'required',
            'menu_id' => 'required|numeric',
            'language_id' => 'required|max:2',
        ]);
        //2. Find menu by id
        $menu = Menu::where([
            'id'=> $request->input('menu_id'),
            'status' => 1
        ]);
        
        if($menu!=null){
            $menuTranslations = MenuTranslation::where($request->only('menu_id','language_id'));
            if($menuTranslations==null){
                $menuTranslations = new MenuTranslation($request->all());
                $menu->menuTranslation()->save($menuTranslations);
            }else{
                $menuTranslations->update($request->except('_token'));
            }
            //5. FLASH MESSAGE BACK
            Session::flash('flash_message', 'Menu successfully translated!');
        }else{
            //5. FLASH MESSAGE BACK
            Session::flash('flash_message', 'Menu not found!!!');
        }

        //6. REDIRECT BACK
        return redirect()->back();*/
    }
}
