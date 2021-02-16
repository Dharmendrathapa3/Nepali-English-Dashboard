<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
   
       
    public function __construct(Tag $tag)
    {
        $this->middleware(['permission:view-Tags|add-Tags|update-Tags|delete-Tags'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:add-Tags'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-Tags'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-Tags'], ['only' => ['destroy']]);
        $this->tag = $tag;

        $this->middleware('auth');
    }

    
    public function index()
    {
        $tags=Tag::paginate(2);
        
        return view('CMS/Tag/show',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Add';
        $tags=null;
        return view('CMS/Tag/form', compact('text','tags'));
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

        $tags=new Tag();
        $tags->name=$request->name;
        $tags->description=$request->description;
        $tags->status=$request->status;

        $tags->save();
        return redirect( route('tag.index') )->with('success','Tag Added successfully!');
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
        $tags=Tag::find($id);
        return view('CMS/Tag/form', compact('text','tags'));
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

        $tags=Tag::find($id);
        $tags->name=$request->name;
        $tags->description=$request->description;
        $tags->status=$request->status;

        $tags->save();
        return redirect( route('tag.index') )->with('success','Tag Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::find($id)->delete();
        return redirect( route('tag.index') )->with('error','Tag Deleted successfully!');
    }

    public function search( Request $request)
    {
        // dd($request->keyword);

        $tags = Tag::where('name', 'like', '%' . $request->keyword . '%')->paginate(20);

        return view('CMS/Tag/show',compact('tags'));
    }
}
