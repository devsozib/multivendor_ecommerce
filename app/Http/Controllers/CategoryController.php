<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('backend.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $parent_categories = Category::where('is_parent',1)->orderBy('title','ASC')->get();
        return view('backend.categories.create',compact('parent_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
              
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'is_parent'=>'sometimes|in:1',
            'parent_id'=>'nullable|exists:categories,id',
            'status'=>'nullable|in:active,inactive'
        ]);

        $data = $request->all();
        $slug =Str::slug($request->input('title'));
        $slug_count = Category::where('slug',$slug)->count();

        if($slug_count > 0){
            $slug.=time().'-'.$slug;
        }

         $data['slug']=$slug;

         $data['is_parent'] = $request->input('is_parent',0);

     
        $status = Category::create($data);

        if($status){
              return redirect()->route('category.index')->with('success', 'Yes! Category Added Success');
        }
        else{
            return back()->with('error','Something is wrong please cheak and try again');
        }
    }

    public function categoryStatus(Request $request){
         
        if($request->mode=='true'){
            DB::table('categories')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('categories')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['message'=>'Status update success', 'status'=>true]);
    } 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::find($id);
        $parent_categories = Category::where('is_parent',1)->orderBy('title','ASC')->get();

        if($categories){
            return view('backend.categories.edit',compact(['categories','parent_categories']));
        }
        else{
            return back()->with('error','Data not found');
        }
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

        $categories = Category::find($id);
           
        if($categories){
            $this->validate($request,[
              
                'title'=>'string|required',
                'summary'=>'string|nullable',
                'is_parent'=>'sometimes|in:1',
                'parent_id'=>'nullable|exists:categories,id',
                'status'=>'nullable|in:active,inactive'
            ]);
    
            $data = $request->all();
            
                if($request->is_parent==1){
                    $data['parent_id']=null;
                }
             $data['is_parent'] = $request->input('is_parent',0);
    
         
            $status =$categories->fill($data)->save();
    
            if($status){
                  return redirect()->route('category.index')->with('success', 'Yes! Category updated Success');
            }
            else{
                return back()->with('error','Something is wrong please cheak and try again');
            }
        }
        else{
            return back()->with('error','Data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::find($id);
          $child_cat_id = Category::where('parent_id',$id)->pluck('id');
        if($categories){
           $status = $categories->delete();
           if($status){
               if(count($child_cat_id) >0){
                   Category::shiftChild($child_cat_id);
               }
               return redirect()->route('category.index')->with('success','Yes! Category Deleted Successfull');
           }
           else{
               return back()->with('error','Something is wrong');
           }
        }
        else{
            return back()->with('error','Data not found');
        }
    }
}
