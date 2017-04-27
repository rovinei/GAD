<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\CategoryTranslation;
use DB;
use Auth;
use Session;
use Image;

class CategoryController extends Controller
{
    public function __construct(){
        /*$this->middleware('auth');*/
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(15);
        return View('admin.categories.category')->with('categories', $categories);
    }
    
    public function json(Request $requests){
        $limit = $requests->input('limit') ? $requests->input('limit') : 15;
        if($limit>100 || $limit<=0){
            $limit = 15;
        }
        $categories = Category::where('title', 'like','%'.$requests->input('search').'%')->paginate($limit);
        $data = View('admin.categories.category_template')->with('categories', $categories)->render();
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
        return View('admin.categories.create_category')->with([
            'categories' => $categories//Category::where('status', 1)->get()
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
                'title' => 'required|unique:category_translations',
                'status' => 'required'
            ]);
            
            //2. GET ALL REQUESTS AND CREATE MENU OBJECT
            $input = $request->all();
            if($request->input('parent_id')==''){
                $input = $request->except('parent_id');
            }else{
                $input["level"] = Category::findOrFail($request->input('parent_id'))->level + 1;
                
            }
            
            $category = new Category($input);
    
            //3. SET CREATED USER TO THE MENU
            $category->createdby()->associate(Auth::user());
            $category->updatedBy()->associate(Auth::user());
            $category->thumb_image = str_replace('source','thumbs',$request->input('image'));
            /*$filename ='';
            if ($request->hasFile('image')) {
                if(!file_exists('images/uploads')){
                    mkdir('images/uploads/originals/','777', true);
                }
                $image = $request->file('image');
                $filename = uniqid() . $image->getClientOriginalName();

                $image->move('images/uploads/original/', $filename);
                
                $thumb = Image::make('images/uploads/original/'.$filename)
                              ->resize(240,160)
                              ->save('images/uploads/thumb/'.$filename,50);
                //dd($image);
                
                $category->image = 'images/uploads/original/'.$filename;
                $category->thumb_image = 'images/uploads/thumb/'.$filename;
            }*/
            
            //$filename = $this->uploadImage($request);
            //$category->image = url().'/images/source/'.$filename;
            //$category->thumb_image = url().'/images/thumbs/'.$filename;
            
            //$category->thumb_image = $filename;
            //$category->thumb_image = $request->input('image');
            //$category->thumb_image = str_images/source('source','thumbs',$category->thumb_image);
    
            //4. SAVE MENU
            $category->save();
            
            //$categoryTranslation = new CategoryTranslation($request->all());
            
            //$category->categoryTranslation()->save($categoryTranslation);
    
            //5. FLASH MESSAGE BACK
            Session::flash('flash_message', 'Category successfully added!');
            
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
        $category = Category::findOrFail($id);
        return View('admin.categories.translate_category')->with([
            'languages' => \App\Language::where([
                                            'status' => 1,
                                            'is_default' => false])->get(),
            'category' => $category
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
        $category = Category::findOrFail($id);
        $categories = DB::table('categories')->select('categories.id','categories.title','categories.level',
                            DB::raw("(CASE categories.level 
                                      WHEN 0 THEN LPAD(categories.ordering,5,0)
                                      WHEN 1 THEN (SELECT CONCAT(LPAD(m.ordering,5,0), '.' ,LPAD(categories.ordering,5,0)) FROM categories as m WHERE m.id=categories.parent_id)
                                      WHEN 2 THEN (SELECT CONCAT((SELECT LPAD(super.ordering,5,0) FROM categories AS super WHERE super.id = m.parent_id), '.' , LPAD(m.ordering,5,0), '.' ,LPAD(categories.ordering,5,0)) FROM categories as m WHERE m.id=categories.parent_id)
                                      END) AS Pos"))
                      ->where('status',1)
                      ->where('id','<>',$id)
                      ->whereNull('deleted_at')
                      ->orderBy('Pos')
                      ->get();
        return View('admin.categories.update_category')->with([
            'categories' => $categories,
            'category' => $category
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
        //
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json([
            'STATUS' => true
        ]);
    }
    
    public function updateCategory(Request $request){
        $this->validate($request, [
            'title' => 'required',
            //'description' => 'required',
            'id' => 'required|numeric',
            'status' => 'required',
            'parent_id' => 'numeric'
        ]);
        $category = Category::findOrFail($request->input('id'));
        $input = $request->all();
        if($request->input('parent_id')==''){
            $input = $request->except('parent_id');
            $input['parent_id'] = NULL;
        }else{
            $input["level"] = Category::findOrFail($request->input('parent_id'))->level + 1;
            
        }
        //$filename = $this->uploadImage($request);
        //$input['image'] = url().'/images/source/'.$filename;
        //$input['thumb_image'] = url().'/images/thumbs/'.$filename;
        $input['thumb_image'] = str_replace('source','thumbs',$request->input('image'));
        $category->updatedBy()->associate(Auth::user());
        $category->update($input);
        
        
        
        //$category->thumb_image = $request->input('image');
        //$category->thumb_image = str_images/source('source','thumbs',$category->thumb_image);
        
        Session::flash('flash_message', 'Category successfully updated!');
        
        return redirect()->back();
    }
    
    public function translate(Request $request){
        $validation = $this->validate($request, [
            'category_id' => 'required|numeric',
            'language_id' => 'required|max:2',
        ]);
        $categoryTranslation = CategoryTranslation::firstOrNew($request->all());
        if($categoryTranslation->exists){
            return response()->json([
               'DATA' => $categoryTranslation
            ]);
        }else{
            return response()->json([
                'DATA' => null
            ]);
        }
    }
    
    
    public function translation(Request $request){
        //1. Validation 
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required|numeric',
            'parent_id' => 'numeric',
            //'description' => 'required',
        ]);
        //2. Find menu by id
        $category = Category::firstOrNew([
            'id'=> $request->input('category_id')
        ]);
        
        try{
            if($category->exists){
                $categoryTranslation = CategoryTranslation::firstOrNew($request->only('category_id','language_id'));
                if(!$categoryTranslation->exists){
                    $categoryTranslation = new CategoryTranslation($request->all());
                    $categoryTranslation->save();
                    //5. FLASH MESSAGE BACK
                    Session::flash('flash_message', 'Category successfully translated!');
                }else{
                    $categoryTranslation::where('category_id', $request->input('category_id'))
                                        ->where('language_id', $request->input('language_id'))
                                        ->update($request->only('description','title'));
                    //5. FLASH MESSAGE BACK
                    Session::flash('flash_message', 'Category successfully translate updated!');
                }
            }else{
                //5. FLASH MESSAGE BACK
                Session::flash('flash_message', 'Category not found!!!');
            }
        }catch(Exception $e){
            
        }

        //6. REDIRECT BACK
        return redirect()->back();
    }
    
    private function uploadImage($request){
        $filename ='';
        if ($request->hasFile('image')) {
            if(!file_exists('images/uploads')){
                mkdir('images/source/','777', true);
            }
            $image = $request->file('image');
            $filename = uniqid() . $image->getClientOriginalName();

            $image->move('images/source/', $filename);
            
            $thumb = Image::make('images/source/'.$filename)
                          ->resize(240,160)
                          ->save('images/thumbs/'.$filename,50);
            
        }
        return $filename;
    }
}
