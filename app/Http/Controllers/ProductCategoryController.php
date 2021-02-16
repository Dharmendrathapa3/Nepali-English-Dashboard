<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProductCategoryController extends Controller
{


    public function __construct(ProductCategory $productcategory)
    {
        $this->middleware(['permission:view-Product_Categories|add-Product_Categories|update-Product_Categories|delete-Product_Categories'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:add-Product_Categories'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-Product_Categories'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-Product_Categories'], ['only' => ['destroy']]);
        $this->productcategory = $productcategory;

        $this->middleware('auth');
    }

    public function index()
    {
        $productcatgeories = ProductCategory::paginate(10);
        // dd($productcatgeories);

        return view('CMS/Product/Category/show', compact('productcatgeories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Add';

        $productcatgeory = ProductCategory::with(['childrenCategories'])->where('parent', null)->get();
        $procat = null;
       
        return view('CMS/Product/Category/form', compact('text', 'productcatgeory'));
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

        $productcatgeory = new ProductCategory();

        $productcatgeory->name = $request->name;
        $productcatgeory->parent = $request->parent;
        $productcatgeory->descroption = $request->descroption;
        $productcatgeory->stauts = $request->stauts;
        $productcatgeory->position = $request->position;

        $productcatgeory->save();
        return redirect(route('ProductCategory.index'))->with('success', 'Product Category Added successfully!');
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
        $productcatgeory = ProductCategory::with(['child'])->where('parent', null)->get();

        $procat = ProductCategory::find($id);
        return view('CMS/Product/Category/form', compact('text', 'productcatgeory', 'procat'));
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

        $productcatgeory = ProductCategory::find($id);

        $productcatgeory->name = $request->name;
        $productcatgeory->parent = $request->parent;
        $productcatgeory->descroption = $request->descroption;
        $productcatgeory->stauts = $request->stauts;
        $productcatgeory->position = $request->position;

        $productcatgeory->save();
        return redirect(route('ProductCategory.index'))->with('success', 'Product Category Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductCategory::find($id)->delete();
        return redirect(route('ProductCategory.index'))->with('error', 'Product Category Deleted successfully!');
    }

    public function search(Request $request)
    {
        $productcatgeories = ProductCategory::where('name', 'like', '%' . $request->keyword . '%')->paginate(20);

        return view('CMS/Product/Category/show', compact('productcatgeories'));
    }




    // public function categoryTree( $sub_mark = '', $htmlOption = null)
    // {
    //     $categories = ProductCategory::where('id', null)->get();
    //     if (count($categories) > 0) {
    //         $tes = "";
    //         foreach ($categories as $row) {
    //             if ($row->id == $this->selectCategoryId) {
    //                 $tes = " selected";
    //             } else {
    //                 $tes = "";
    //             }
    //             $htmlOption .= '<option value="' . $row->id . '"' . $tes . '>' . $sub_mark . $row->category_name . '</option>';
    //             $htmlOption .= $this->categoryTree($row->id, $sub_mark . '&nbsp&nbsp&nbsp&nbsp');
    //         }
    //     }
    //     return  $htmlOption;
    // }


    public function TreeView()
    {
        $categories = ProductCategory::whereNull('parent')
        ->with('childrenCategories')
        ->get();
    return view('Tree/categories', compact('categories'));
    }
}
