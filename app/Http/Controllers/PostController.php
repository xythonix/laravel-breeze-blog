<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // FOR MOVING TO ADD POST PAGE
    public function index()
    {
        $categories = Category::all();

        return view('admin.add_post',compact('categories'));
    }

    // FOR BLOG PAGE
    public function blogPage()
    {
        $posts = Post::with(['Category','Author'])->orderByDesc('id')->paginate(8);

        return view('guest.welcome', compact('posts'));
    }

    // DASHBOARD DATA
    public function dashboard()
    {
        $user_name = Auth::user()->username;

        $post_count = Author::find(Auth::id());
        $post_count = $post_count->post_count;

        $user_joined = DB::table('users')
                        ->where('username',$user_name)
                        ->get();
        $user_joined = $user_joined[0]->created_at;

        $mostUsedCategory = DB::table('posts')
                            ->select('cat_id', DB::raw('count(*) as category_count'))
                            ->where('author_id', Auth::id())
                            ->groupBy('cat_id')
                            ->orderByDesc('category_count')
                            ->first();

        if ($mostUsedCategory) {
            $categoryId = $mostUsedCategory->cat_id;
            $categoryCount = $mostUsedCategory->category_count;

            // Retrieve the category model for the most used category
            $mostUsedCategoryModel = Category::find($categoryId);
        } else {
            // Handle the case where the author has no posts or no distinct categories
            $categoryId = null;
            $categoryCount = 0;
            $mostUsedCategoryModel = null;
        }

        return view('admin.dashboard',compact([
            'user_name', 'post_count', 'user_joined','mostUsedCategoryModel'
        ]));
    }

    // FOR MOVING TO POSTS PAGE
    public function movePosts()
    {
        $posts = Post::with('Category')
                    ->where('author_id',Auth::id())
                    ->orderBy('id','DESC')
                    ->paginate(15);

        return view('admin.posts',compact('posts'));
    }

    // FOR MOVING TO UPDATE PAGE
    public function moveUpdatePost(string $id)
    {
        $post = Post::with('Category')->find($id);
        $categories = Category::all();

        return view('admin.update_post',compact(['post','categories']));
    }

    // FOR UPDATING POST DATA
    public function updateData(Request $req, string $id, string $cat_id)
    {
        $category_name = '';
        $image_name = '';

        $req->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // IF USER SELECTS IMAGE
        if($req->file('image'))
        {
            $image_name = $req->file('image')->getClientOriginalName();

            $req->file('image')->storeAs('images',$image_name,'public');

            Storage::disk('public')->delete('images/'.$req->input('hidden_image'));
        }
        else 
        {
            $image_name = $req->input('hidden_image');
        }

        // IF USER SELECTS CATEGORY
        if($req->category != 'Select Category')
        {
            $category_name = $req->category;
        }
        else
        {
            $category_name = $cat_id;
        }


        // UPDATING RECORD
        $data = DB::table('posts')
                ->where('id',$id)
                ->update([
                    'title' => $req->title,
                    'description' => $req->description,
                    'post_img' => $image_name,
                    'cat_id' => $category_name,
                    'author_id' => Auth::id(),
                    'updated_at' => now(),
                ]);
        if($data)
            return redirect()->route('view.posts');
    }

    // FOR MOVING TO VIEW POST PAGE
    public function moveViewPost(string $id)
    {
        $post = Post::with(['Category','Author'])->find($id);

        return view('admin.view_post',compact('post'));
    }

    // FOR INSERTING POST
    public function insertData(Request $req)
    {
        $req->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required',
            'image' => 'max:2048|image|mimes:jpg,jpeg,png',
        ]);

        if($req->hasFile('image'))
        {
            $image_file = $req->file('image');

            $image_name = $image_file->getClientOriginalName();
            $image_file->storeAs('images',$image_name,'public');
    
            // ID FOR AUTHENTICATED USER
            $user_id = Auth::id();
    
            $category = Category::find($req->category);
            $authors = Author::find($user_id);
    
            DB::table('categories')
                ->where('id',$req->category)
                ->update([
                    'post_count' => ($category->post_count + 1),
                ]);

            DB::table('authors')
                ->where('id',$user_id)
                ->update([
                    'post_count' => ($authors->post_count + 1),
                ]);
    
            $post = new Post([
                'title' => $req->title,
                'description' => $req->description,
                'cat_id' => $req->category,
                'author_id' => $user_id,
                'post_img' => $image_name,
            ]);
    
            $post->save();
    
            return redirect()->route('view.posts');
        }
        else
        {
            // ID FOR AUTHENTICATED USER
            $user_id = Auth::id();
    
            $category = Category::find($req->category);
            $authors = Author::find($user_id);

            DB::table('categories')
                ->where('id',$category->id)
                ->update([
                    'post_count' => ($category->post_count + 1),
                ]);

            DB::table('authors')
                ->where('id',$authors->id)
                ->update([
                    'post_count' => ($authors->post_count + 1),
                ]);
    
            $post = new Post([
                'title' => $req->title,
                'description' => $req->description,
                'cat_id' => $req->category,
                'author_id' => $user_id,
            ]);
    
            $post->save();
    
            return redirect()->route('view.posts');
        }
    }

    // FOR DELETING POST DATA
    public function deleteData(string $id, string $cat_id)
    {
        // ID FOR AUTHENTICATED USER
        $user_id = Auth::id();

        $data = Post::find($id);
        $data->delete();

        $category = Category::find($cat_id);
        $authors = Author::find($user_id);

        DB::table('categories')
            ->where('id',$cat_id)
            ->update([
                'post_count' => ($category->post_count - 1),
            ]);

        DB::table('authors')
        ->where('id',$authors->id)
        ->update([
            'post_count' => ($authors->post_count - 1),
        ]);

        Storage::disk('public')->delete('images/'.$data->post_img);
    
        return redirect()->route('view.posts');
    }
}
