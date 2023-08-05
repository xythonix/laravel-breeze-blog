<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // FOR BLOG PAGE
    public function blogPage()
    {
        $posts = Post::with(['Category','Author'])->orderByDesc('id')->paginate(8);

        return view('guest.welcome', compact('posts'));
    }

    // FOR LOGIN PAGE
    public function login()
    {
        return view('auth.login');
    }

    // FOR REGISTER PAGE
    public function register()
    {
        return view('auth.register');
    }

    // FOR SINGLE BLOG POST
    public function moveSingle(string $id)
    {
        $post = Post::with(['Category','Author'])->find($id);

        return view('guest.single',compact('post'));
    }

    // FOR CATEGORY POSTS
    public function categoryPosts(string $id)
    {
        $categories = Category::with('Post')->where('id',$id)->orderBy('id','DESC')->paginate(8);

        $category_name = Category::find($id);
        $category_name = $category_name->name;

        return view('guest.category',compact([
            'categories','category_name',
        ]));
    }

    public function authorPosts(string $id)
    {
        $authors = Author::with('Post')->where('id',$id)->paginate(8);
        
        $auther_name = Author::find($id);
        $author_name = $auther_name->name;

        return view('guest.author',compact([
            'author_name','authors',
        ]));
    }

    public function searchData(Request $req){
        $search_val = $req->input('inp_search');

        $posts = Post::with(['Category','Author'])
                    ->where('title','LIKE','%'.$search_val.'%')
                    ->orWhere('description','LIKE','%'.$search_val.'%')
                    ->paginate(8);

        return view('guest.search',compact([
            'search_val','posts',
        ]));
    }
}
