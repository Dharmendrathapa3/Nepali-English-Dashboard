<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TestimonialController extends Controller
{
     
    public function __construct(Testimonial $testimonial)
    {
        $this->middleware(['permission:view-Testimonial|add-Testimonial|update-Testimonial|delete-Testimonial'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:add-Testimonial'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-Testimonial'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-Testimonial'], ['only' => ['destroy']]);
        $this->testimonial = $testimonial;

        $this->middleware('auth');
    }
    
    public function index()
    {
        $testimoniales=Testimonial::paginate(2);
        return view('CMS/Testimonial/show',compact('testimoniales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text='Add';
        $testimoniales=null;
        return view('CMS/Testimonial/form',compact('text','testimoniales'));
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

            'name'=>'required',
        ]);

        $testimoniales= new Testimonial();
        $testimoniales->name=$request->name;
        $testimoniales->description=$request->description;
        $testimoniales->position=$request->position;
        $testimoniales->status=$request->status;

        //for image
        if($request->image)
        {
            $image1 = imageupload($request->image, 'upload');
            $testimoniales->image = $image1;
        }

        $testimoniales->save();

        return redirect(route('testimonial.index'))->with('success','Testimonial Added successfully!');

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
        $text='Edit';
        $testimoniales=Testimonial::find($id);
        return view('CMS/Testimonial/form',compact('text','testimoniales'));
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

            'name'=>'required',
        ]);

        $testimoniales= Testimonial::find($id);
        $testimoniales->name=$request->name;
        $testimoniales->description=$request->description;
        $testimoniales->position=$request->position;
        $testimoniales->status=$request->status;

        //for image
        if($request->image)
        {
            $image1 = imageupload($request->image, 'upload');
            $testimoniales->image = $image1;
        }

        $testimoniales->save();

        return redirect(route('testimonial.index'))->with('success','Testimonial Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Testimonial::find($id)->delete();
        return redirect(route('testimonial.index'))->with('error','Testimonial Deleted successfully!');
    }

    public function search(Request $request)
    {
        // dd($request->keyword);

        $testimoniales = Testimonial::where('name', 'like', '%' . $request->keyword . '%')->paginate(20);
        return view('CMS/Testimonial/show',compact('testimoniales'));
    }
}
