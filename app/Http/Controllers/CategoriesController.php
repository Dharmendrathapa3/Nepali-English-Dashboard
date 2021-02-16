<?php

namespace App\Http\Controllers;

use App\Categories;
use App\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CategoriesController extends Controller
{
   
    public function __construct(Categories $category)
    {
        $this->middleware(['permission:view-Menu_Categories|add-Menu_Categories|update-Menu_Categories|delete-Menu_Categories'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:add-Menu_Categories'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-Menu_Categories'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-Menu_Categories'], ['only' => ['destroy']]);
        $this->category = $category;

        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $menu_category = MenuCategory::paginate(4);

        if ($request->ajax()) {

            return view('CMS/Category/data', compact('menu_category'));

        }
        return view('CMS/Category/show', compact('menu_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Add ';
        $menu_category = null;
        return view('CMS/Category/form', compact('text', 'menu_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required'

        ]);


        $menu_category = new MenuCategory();
        $menu_category->title = $request->title;
        $menu_category->description = $request->description;
        $menu_category->show_on = $request->show_on;
        $menu_category->position = $request->position;
        $menu_category->status = $request->status;

        //for imageupload
        if ($request->feature_img) {
            $image = imageupload($request->feature_img, 'upload');
            $menu_category->feature_img = $image;
        }

        if ($request->parallex_img) {
            $image1 = imageupload($request->parallex_img, 'upload');
            $menu_category->parallex_img = $image1;
        }
        $menu_category->save();
        return redirect(route('catrgories.index'))->with('success','Menu Category Added successfully!');
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
        $menu_category = MenuCategory::find($id);

        return view('CMS/Category/form', compact('text', 'menu_category'));
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
            'title' => 'required'

        ]);

        $menu_category = MenuCategory::find($id);
        $menu_category->title = $request->title;
        $menu_category->description = $request->description;
        $menu_category->show_on = $request->show_on;
        $menu_category->position = $request->position;
        $menu_category->status = $request->status;

        //for imageupload

        if ($request->feature_img) {
            $image = imageupload($request->feature_img, 'upload');
            $menu_category->feature_img = $image;
        }

        if ($request->parallex_img) {
            $image1 = imageupload($request->parallex_img, 'upload');
            $menu_category->parallex_img = $image1;
        }

        $menu_category->save();
        return redirect(route('catrgories.index'))->with('success','Menu Category Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MenuCategory::find($id)->delete();
        return redirect(route('catrgories.index'))->with('error','Menu Category Deleted successfully!');
    }


    public function search(Request $request)
    {
        // dd($request->keyword);

        $menu_category = MenuCategory::where('title', 'like', '%' . $request->keyword . '%')->paginate(20);
        if ($request->ajax()) {

            return view('CMS/Category/data', compact('menu_category'));

        }
        return view('CMS/Category/show', compact('menu_category'));
    }
}
