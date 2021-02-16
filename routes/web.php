<?php


use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\CKeditorController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Contracts\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return  redirect()->back();
})->name('setLanguage');



Auth::routes();

Route::group(['middleware' => ['auth', 'active_user']], function () {


    Route::get('/', [MainController::class, 'index']);
    Route::post('ckeditor/upload', [CKeditorController::class, 'upload'])->name('ckeditor.upload');


    Route::get('catrgories/index', [CategoriesController::class, 'index'])->name('catrgories.index');
    Route::get('catrgories/create', [CategoriesController::class, 'create'])->name('catrgories.create');
    Route::post('catrgories/store', [CategoriesController::class, 'store'])->name('catrgories.store');
    Route::get('catrgories/edit/{id}', [CategoriesController::class, 'edit'])->name('catrgories.edit');
    Route::post('catrgories/update/{id}', [CategoriesController::class, 'update'])->name('catrgories.update');
    Route::get('catrgories/destroy/{id}', [CategoriesController::class, 'destroy'])->name('catrgories.destroy');

    Route::get('catrgories/search', [CategoriesController::class, 'search'])->name('catrgories.search');




    Route::get('content/index', [ContentController::class, 'index'])->name('content.index');
    Route::get('content/create', [ContentController::class, 'create'])->name('content.create');
    Route::post('content/store', [ContentController::class, 'store'])->name('content.store');
    Route::get('content/edit/{id}', [ContentController::class, 'edit'])->name('content.edit');
    Route::post('content/update/{id}', [ContentController::class, 'update'])->name('content.update');
    Route::get('content/destroy/{id}', [ContentController::class, 'destroy'])->name('content.destroy');

    Route::get('content/search', [ContentController::class, 'search'])->name('content.search');




    Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('product/search', [ProductController::class, 'search'])->name('product.search');



    Route::get('ProductCategory/index', [ProductCategoryController::class, 'index'])->name('ProductCategory.index');
    Route::get('ProductCategory/create', [ProductCategoryController::class, 'create'])->name('ProductCategory.create');
    Route::post('ProductCategory/store', [ProductCategoryController::class, 'store'])->name('ProductCategory.store');
    Route::get('ProductCategory/edit/{id}', [ProductCategoryController::class, 'edit'])->name('ProductCategory.edit');
    Route::post('ProductCategory/update/{id}', [ProductCategoryController::class, 'update'])->name('ProductCategory.update');
    Route::get('ProductCategory/destroy/{id}', [ProductCategoryController::class, 'destroy'])->name('ProductCategory.destroy');

    Route::get('ProductCategory/search', [ProductCategoryController::class, 'search'])->name('ProductCategory.search');
    Route::get('Tree', [ProductCategoryController::class, 'TreeView']);




    Route::get('slider/index', [SliderController::class, 'index'])->name('slider.index');
    Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('slider/destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

    Route::get('slider/search', [SliderController::class, 'search'])->name('slider.search');




    Route::get('tag/index', [TagController::class, 'index'])->name('tag.index');
    Route::get('tag/create', [TagController::class, 'create'])->name('tag.create');
    Route::post('tag/store', [TagController::class, 'store'])->name('tag.store');
    Route::get('tag/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
    Route::post('tag/update/{id}', [TagController::class, 'update'])->name('tag.update');
    Route::get('tag/destroy/{id}', [TagController::class, 'destroy'])->name('tag.destroy');

    Route::get('tag/search', [TagController::class, 'search'])->name('tag.search');




    Route::get('testimonial/index', [TestimonialController::class, 'index'])->name('testimonial.index');
    Route::get('testimonial/create', [TestimonialController::class, 'create'])->name('testimonial.create');
    Route::post('testimonial/store', [TestimonialController::class, 'store'])->name('testimonial.store');
    Route::get('testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
    Route::post('testimonial/update/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
    Route::get('testimonial/destroy/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');

    Route::get('testimonial/search', [TestimonialController::class, 'search'])->name('testimonial.search');



    Route::get('gallery/index', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('gallery/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::post('gallery/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::get('gallery/destroy/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('gallery/search', [GalleryController::class, 'search'])->name('gallery.search');
    Route::post('gallery/imagedelete', [GalleryController::class, 'imagedelete'])->name('gallery.imagedelete');



    Route::get('users/index', [UserController::class, 'index'])->name('user.index');
    Route::get('users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('users/store', [UserController::class, 'store'])->name('user.store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('users/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('users/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');



    Route::get('users/changepasswordform/{id}', [UserController::class, 'changepasswordform'])->name('user.changepasswordform');
    Route::post('users/changepassword/{id}', [UserController::class, 'changepassword'])->name('user.changepassword');
    Route::get('users/search', [UserController::class, 'search'])->name('user.search');
    Route::get('user/trash/search', [UserController::class, 'trashsearch'])->name('user.trash.search');
    Route::get('user/trash/index', [UserController::class, 'trashuser'])->name('user.trash.index');
    Route::get('user/trash/restore/{id}', [UserController::class, 'trashrestore'])->name('user.trash.restore');
    Route::get('user/trash/delete/{id}', [UserController::class, 'trashdelete'])->name('user.trash.delete');
    Route::get('user/trash/search', [UserController::class, 'trashsearch'])->name('user.trash.search');



    Route::get('role/index', [RoleController::class, 'index'])->name('role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::get('role/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

    Route::get('role/search', [RoleController::class, 'search'])->name('role.search');





    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', [MainController::class, 'index'])->name('dashboard');
    // ... Any other routes that are accessed only by non-blocked user



});
