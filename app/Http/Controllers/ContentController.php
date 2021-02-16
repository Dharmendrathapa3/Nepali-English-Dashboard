<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ContentController extends Controller
{

    public function __construct(Content $content)
    {
        $this->middleware(['permission:view-Content|add-Content|update-Content|delete-Content'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:add-Content'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-Content'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-Content'], ['only' => ['destroy']]);
        $this->content = $content;

        $this->middleware('auth');
    }


    public function index()
    {
        $content = Content::paginate(2);
        return view('CMS/Content/show', compact('content'));

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Add';
        $content = null;
        return view('CMS/Content/form', compact('text'));
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

            'title' => 'required',
            'meta_title' => 'required',
        ]);

        $content = new Content();
        $content->title = $request->title;
        $content->description = $request->description;
        $content->short_description = $request->short_description;
        $content->subtitle = $request->subtitle;
        $content->status = $request->status;
        $content->show_on = $request->show_on;
        $content->meta_title = $request->meta_title;
        $content->meta_keyword = $request->meta_keyword;
        $content->meta_description = $request->meta_description;

        //for imageupload

        if ($request->feature_img) {

            $image = imageupload($request->feature_img, 'upload');
            $content->feature_img = $image;
        }

        if ($request->parallex_img) {
            $image1 = imageupload($request->parallex_img, 'upload');
            $content->parallex_img = $image1;
        }


        $content->save();

        return redirect(route('content.index'))->with('success', 'Content Added successfully!');
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
        $content = Content::find($id);

        return view('CMS/Content/form', compact('text', 'content'));
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

            'title' => 'required',
            'meta_title' => 'required',
        ]);

        $content = Content::find($id);
        $content->title = $request->title;
        $content->description = $request->description;
        $content->short_description = $request->short_description;
        $content->subtitle = $request->subtitle;
        $content->status = $request->status;
        $content->show_on = $request->show_on;
        $content->meta_title = $request->meta_title;
        $content->meta_keyword = $request->meta_keyword;
        $content->meta_description = $request->meta_description;



        //for imageupload
        if ($request->feature_img) {
            $image = imageupload($request->feature_img, 'upload');
            $content->feature_img = $image;
        }

        if ($request->parallex_img) {
            $image1 = imageupload($request->parallex_img, 'upload');
            $content->parallex_img = $image1;
        }


        $content->save();

        return redirect(route('content.index'))->with('success', 'Content Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Content::find($id)->delete();
        return redirect(route('content.index'))->with('error', 'Content Deleted successfully!');
    }

    public function search(Request $request)
    {
        $content = Content::where('title', 'like', '%' . $request->keyword . '%')->paginate(20);
        return view('CMS/Content/show', compact('content'));
    }
}
