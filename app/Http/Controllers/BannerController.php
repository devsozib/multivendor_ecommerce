<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    return view('backend.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banners.create');
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
            'description'=>'string|nullable',
            'photo'=>'required',
            'condition'=>'nullable|in:bannar,promote',
            'status'=>'nullable|in:active,inactive',

        ]);

        $data = $request->all();
        $slug =Str::slug($request->input('title'));
        $slug_count = Banner::where('slug',$slug)->count();

        if($slug_count > 0){
            $slug.=time().'-'.$slug;
        }

         $data['slug']=$slug;

     
        $status = Banner::create($data);

        if($status){
              return redirect()->route('banner.index')->with('success', 'Yes! Banner Added Success');
        }
        else{
            return back()->with('error','Something is wrong please cheak and try again');
        }
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
