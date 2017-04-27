<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Content;
use App\ContentTranslation;
use Auth;
use Session;
use DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$contents = Content::all();
        $contents = Content::orderBy('created_at','desc')->paginate(15);
        return View('admin.contents.content')->with('contents', $contents);
    }
    
    public function json(Request $requests){
        $limit = $requests->input('limit') ? $requests->input('limit') : 15;
        if($limit>100 || $limit<=0){
            $limit = 15;
        }
        $contents = Content::where('title', 'like','%'.$requests->input('search').'%')
                           ->orderBy('created_at','desc')
                           ->paginate($limit);
        $data = View('admin.contents.content_template')->with('contents', $contents)->render();
        return response()->json($data);

        /*return response()->json([
            'DATA' => $contents->toJson(),
            'PAGINATION' => $contents->render()
        ]);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contents = Content::all();
        $categories = DB::table('categories')->select('categories.id','categories.title','categories.level',
                            DB::raw("(CASE categories.level 
                                      WHEN 0 THEN LPAD(categories.ordering,5,0)
                                      WHEN 1 THEN (SELECT CONCAT(LPAD(m.ordering,5,0), '.' ,LPAD(categories.ordering,5,0)) FROM categories as m WHERE m.id=categories.parent_id)
                                      WHEN 2 THEN (SELECT CONCAT((SELECT LPAD(super.ordering,5,0) FROM categories AS super WHERE super.id = m.parent_id), '.' , LPAD(m.ordering,5,0), '.' ,LPAD(categories.ordering,5,0)) FROM categories as m WHERE m.id=categories.parent_id)
                                      END) AS Pos"))
                      ->where('status',1)
                      ->orderBy('Pos')
                      ->get();
        return View('admin.contents.create_content')->with([
            'categories' => $categories//\App\Category::where('status', 1)->get()
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|numeric',
            'status' => 'required',
        ]);
        
        $content = new Content($request->all());
        $category = \App\Category::findOrFail($request->input('category_id'));
        
        $content->createdBy()->associate(Auth::user());
        $content->updatedBy()->associate(Auth::user());
        $content->category()->associate($category);
        $content->thumb_images = $request->input('images');
        $content->thumb_images = str_replace('source','thumbs',$content->thumb_images);
        
        $content->save();
        
        Session::flash('flash_message', 'Content successfully added!');
        
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
        $content = Content::findOrFail($id);
        return View('admin.contents.translate_content')->with([
            'languages' => \App\Language::where([
                                            'status' => 1,
                                            'is_default' => false])->get(),
            'content' => $content
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
        $content = Content::findOrFail($id);
        $categories = DB::table('categories')->select('categories.id','categories.title','categories.level',
                            DB::raw("(CASE categories.level 
                                      WHEN 0 THEN LPAD(categories.ordering,5,0)
                                      WHEN 1 THEN (SELECT CONCAT(LPAD(m.ordering,5,0), '.' ,LPAD(categories.ordering,5,0)) FROM categories as m WHERE m.id=categories.parent_id)
                                      WHEN 2 THEN (SELECT CONCAT((SELECT LPAD(super.ordering,5,0) FROM categories AS super WHERE super.id = m.parent_id), '.' , LPAD(m.ordering,5,0), '.' ,LPAD(categories.ordering,5,0)) FROM categories as m WHERE m.id=categories.parent_id)
                                      END) AS Pos"))
                      ->where('status',1)
                      ->orderBy('Pos')
                      ->get();
        return View('admin.contents.update_content')->with([
            'categories' => $categories,
            'content' => $content
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
    
    public function updateContent(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|numeric',
            'status' => 'required',
        ]);
        $content = Content::findOrFail($request->input('id'));
        
        $content->updatedBy()->associate(Auth::user());
        $content->thumb_images = $request->input('images');
        $content->thumb_images = str_replace('source','thumbs',$content->thumb_images);
        $content->update($request->all());
        
        Session::flash('flash_message', 'Content successfully updated!');
        
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
        $content = Content::find($id);
        $content->delete();
        return response()->json([
            'STATUS' => true
        ]);
    }
    
    public function translate(Request $request){
        $validation = $this->validate($request, [
            'content_id' => 'required|numeric',
            'language_id' => 'required|max:2',
        ]);
        $contentTranslation = ContentTranslation::firstOrNew($request->all());
        if($contentTranslation->exists){
            return response()->json([
               'DATA' => $contentTranslation
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
            'content_id' => 'required|numeric',
            'language_id' => 'required|max:2',
            'content' => 'required',
        ]);
        //2. Find menu by id
        $content = Content::firstOrNew([
            'id'=> $request->input('content_id')/*,
            'status' => 1*/
        ]);
        
        try{
            if($content->exists){
                $contentTranslation = ContentTranslation::firstOrNew($request->only('content_id','language_id'));
                if(!$contentTranslation->exists){
                    $contentTranslation = new ContentTranslation($request->all());
                    $contentTranslation->save();
                    //5. FLASH MESSAGE BACK
                    Session::flash('flash_message', 'Content successfully translated!');
                }else{
                    $contentTranslation::where('content_id', $request->input('content_id'))
                                       ->where('language_id', $request->input('language_id'))
                                       ->update($request->only('content','title','images'));
                    //5. FLASH MESSAGE BACK
                    Session::flash('flash_message', 'Content successfully translate updated!');
                }
            }else{
                //5. FLASH MESSAGE BACK
                Session::flash('flash_message', 'Content not found!!!');
            }
        }catch(Exception $e){
            
        }

        //6. REDIRECT BACK
        return redirect()->back();
    }
}
