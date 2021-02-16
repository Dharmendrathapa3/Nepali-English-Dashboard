<?php
namespace App\Http\View\Composers;

use App\MenuCategory;
use App\Product;
use App\Tag;
use App\Gallery;
use App\Content;
use App\Testimonial;
use App\Slider;
use App\User;
use Illuminate\View\View;
class NotificationComposer
{
    public function compose(View $view)
    {
        $menucategories=MenuCategory::all();
        $product=Product::all();
        $tag=Tag::all();
        $gallery=Gallery::all();
        $content=Content::all();
        $testimonial =Testimonial::all();
        $slider=Slider::all();
        $users=User::all();        
        
        $view->with([
            'menucategories' => $menucategories,
            'product' => $product,
            'tag' => $tag,
            'gallery' => $gallery,
            'content' => $content,
            'testimonial' => $testimonial,
            'slider' => $slider,
            'users' => $users,
        ]);
    }
}