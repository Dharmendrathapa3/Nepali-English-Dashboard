<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SliderController extends Controller
{
       
    public function __construct(Slider $slider)
    {
        $this->middleware(['permission:view-Slider|add-Slider|update-Slider|delete-Slider'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:add-Slider'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-Slider'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-Slider'], ['only' => ['destroy']]);
        $this->slider = $slider;

        $this->middleware('auth');
    }

    
    public function index()
    {
        $sliders = Slider::paginate(2);
        return view('CMS/Slider/show', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Add';
        $sliders = null;
        return view('CMS/Slider/form', compact('text','sliders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $sliders = new Slider();
        $sliders->name = $request->name;
        $sliders->sub_title = $request->sub_title;
        $sliders->description = $request->description;
        $sliders->position = $request->position;
        $sliders->status = $request->status;

        //for image
        if ($request->img) {
            $image1 = imageupload($request->img, 'upload');
            $sliders->img = $image1;
        }

        $sliders->save();
        return redirect(route('slider.index'))->with('success','Slider Added successfully!');
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
        $text = 'Edit';
        $sliders = Slider::find($id);

        return view('CMS/Slider/form', compact('text','sliders'));
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
        $request->validate([
            'name' => 'required'
        ]);

        $sliders = Slider::find($id);
        $sliders->name = $request->name;
        $sliders->sub_title = $request->sub_title;
        $sliders->description = $request->description;
        $sliders->position = $request->position;
        $sliders->status = $request->status;

        //for image
        if ($request->img) {
            $image1 = imageupload($request->img, 'upload');
            $sliders->img = $image1;
        }

        $sliders->save();
        return redirect(route('slider.index'))->with('success','Slider Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slider::find($id)->delete();
        return redirect(route('slider.index'))->with('error','Slider Deleted successfully!');
    }

    public function search(Request $request)
    {
        // dd($request->keyword);

        $sliders = Slider::where('name', 'like', '%' . $request->keyword . '%')->paginate(20);
        return view('CMS/Slider/show', compact('sliders'));
    }
}
