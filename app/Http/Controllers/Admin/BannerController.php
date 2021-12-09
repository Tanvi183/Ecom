<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    // Image Function
    protected function slideImageUpload($request)
    {
        $file = $request->file('image');
        $file_name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(1400, 500)->save('images'.'/'. $file_name);
        return $file_name;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::orderBy('id', 'desc')->get();
        return view('backend.banner.index', ['banner'=>$banner]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
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
            'title' => 'required|string',
            'description' => 'required|nullable',
            'image' => 'required',
            'condition' => 'nullable|in:banner,promo',
            'status' => 'in:active,inactive'
        ]);

        $input = $request->all();
        $input['image'] = $this->slideImageUpload($request);
        $input['slug'] = Str::slug($request->title);

        $data = Banner::create($input);
        return redirect()->route('admin.banner.index')->with('success', 'Successfully Created Banner');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Banner::findOrFail($id);
        return view('backend.banner.edit', ['data' => $data]);
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
        $this->validate($request,[
            'title' => 'required|string',
            'description' => 'required|nullable',

            'condition' => 'nullable|in:banner,promo',
            'status' => 'in:active,inactive'
        ]);

        $banner = Banner::findOrFail($id);
        $banner->title = $request->title;
        $banner->slug = Str::slug($request->title);
        $banner->description = $request->description;
        $banner->condition = $request->condition;
        $banner->status = $request->status;
        if ($request->hasFile('image')) {
            @unlink('images/'.$banner->image);
            $banner->image = $this->slideImageUpload($request);
        }
        $banner->save();

        return redirect()->route('admin.banner.index')->with('success', 'Successfully Updated Banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        @unlink('images/'.$banner->image);
        $banner->delete();
        return redirect()->back()->with('success', 'Successfully Deleted Banner');
    }

    // Banner Status Update
    public function bannerStatus(Request $request)
    {
        if ($request->mode=='true') {
            DB::table('banners')->where('id', $request->id)->update(['status'=>'active']);
        }else{
            DB::table('banners')->where('id', $request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully Updated Status', 'status'=>true]);
    }
}
