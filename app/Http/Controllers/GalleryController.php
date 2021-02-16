<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GalleryController extends Controller
{
   
   
    public function __construct(Gallery $gallery)
    {
        $this->middleware(['permission:view-Gallery|add-Gallery|update-Gallery|delete-Gallery'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:add-Gallery'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-Gallery'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-Gallery'], ['only' => ['destroy']]);
        $this->gallery = $gallery;

        $this->middleware('auth');
    }


    public function index()
    {
        $gallery = Gallery::paginate(2);
        return view('CMS/Gallery/show', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Add';
        $gallery = null;

        return view('CMS/Gallery/form', compact('text', 'gallery'));
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

            'name' => 'required',
        ]);

        $gallery = new Gallery();
        $gallery->name = $request->name;

        if ($request->img) {
            $image = imageupload($request->img, 'Gallery');
            $gallery->img = $image;
        }

        if ($request->images) {
            $photo = [];

            foreach ($request->images as $image) {

                $photo[] = imageupload($image, 'Gallery');
                $gallery->images = $photo;
            }
        }

        $gallery->save();
        return redirect(route('gallery.index'))->with('success','Gallry Image Added successfully!');
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
        $gallery = Gallery::find($id);

        return view('CMS/Gallery/form', compact('text', 'gallery'));
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

            'name' => 'required',
        ]);

        $gallery = Gallery::find($id);
        $gallery->name = $request->name;
        $oldimages = $gallery->images;

        if ($request->img) {
            $image = imageupload($request->img, 'Gallery');
            $gallery->img = $image;
        }

        if ($request->images) {
            //for update multiple file
            // $oldimages = $gallery->images;

            foreach ($request->images as $image) {

                $photos = imageupload($image, 'Gallery');
                $oldimages[] = $photos;
                $gallery->images = $oldimages;
            }
        }

        $gallery->save();
        return redirect(route('gallery.index'))->with('success','Gallry Image Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::find($id)->delete();
        return redirect(route('gallery.index'))->with('error','Gallry Image Deleted successfully!');
    }

    public function imagedelete(Request $request)
    {

        $name = $request->name;
        $gallery = Gallery::where('id', $request->id)->first();
        $oldvalue = $gallery->images;



        if (in_array($name, $oldvalue)) {
            $image = \array_diff($oldvalue, [$name]);

            $gallery->images = $image;
            $gallery->save();
        } else {
            dd('error');
        }
    }

    public function search(Request $request)
    {
        // dd($request->keyword);

        $gallery = Gallery::where('name', 'like', '%' . $request->keyword . '%')->paginate(20);

        return view('CMS/Gallery/show', compact('gallery'));
    }
}
