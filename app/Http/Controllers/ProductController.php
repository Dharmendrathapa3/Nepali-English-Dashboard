<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{

    public function __construct(Product $product)
    {
        $this->middleware(['permission:view-Product|add-Product|update-Product|delete-Product'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:add-Product'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-Product'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-Product'], ['only' => ['destroy']]);
        $this->product = $product;

        $this->middleware('auth');
    }

    public function index()
    {
        // $productcatgeory=ProductCategory::all();
        $products = Product::with(['productcategory'])->paginate(10);


        return view('CMS/Product/show', compact('products', 'productcatgeory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Add';
        $productcatgeories =ProductCategory::with(['childrenCategories'])->where('parent', null)->get();
        $products = null;
        $arrya[]=null;
        return view('CMS/Product/form', compact('text', 'products', 'productcatgeories','arrya'));
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
            'title' => 'required'
        ]);

        $products = new Product();
        $products->title = $request->title;
        $products->description = $request->description;
        $products->status = $request->status;
        $products->meta_title = $request->meta_title;
        $products->meta_keyword = $request->meta_keyword;
        $products->meta_description = $request->meta_description;
        $products->category_id = $request->category_id;

        //for image
        if ($request->image) {
            $image1 = imageupload($request->image, 'upload');
            $products->image = $image1;
        }

        $products->save();

        return redirect(route('product.index'))->with('success', 'Product Added successfully!');
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
        $productcatgeories =ProductCategory::with(['childrenCategories'])->where('parent', null)->get();
        $forcatid =ProductCategory::all();
        $arrya = [];
        foreach ($forcatid as $value) {
           $arrya[]=$value->id;
        }
        // dd($id_arrya);
        $products = Product::find($id);
        return view('CMS/Product/form', compact('text', 'products', 'productcatgeories','arrya'));
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

        $products = Product::find($id);
        $products->title = $request->title;
        $products->description = $request->description;
        $products->status = $request->status;
        $products->meta_title = $request->meta_title;
        $products->meta_keyword = $request->meta_keyword;
        $products->meta_description = $request->meta_description;
        $products->category_id = $request->category_id;

        //for image
        if ($request->image) {
            $image1 = imageupload($request->image, 'upload');
            $products->image = $image1;
        }

        $products->save();

        return redirect(route('product.index'))->with('success', 'Product Updates successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd("SDAfsdaf");
        Product::find($id)->delete();
        return redirect(route('product.index'))->with('error', 'Product Deleted successfully!');
    }

    public function search(Request $request)
    {
        // dd($request->keyword)

        $products = Product::join('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->orwhere('product_categories.name', 'like', '%' . $request->keyword . '%')
            ->orwhere('products.title', 'like', '%' . $request->keyword . '%')->paginate(10);



        return view('CMS/Product/show', compact('products'));
    }

}
