<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::id())
        {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin')
            {
                return view('admin.index');
            }
            else if ($usertype == 'user')
            {
                return view('home.index');
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    public function category_page()
    {
        $categories = Category::all();
        return view('admin.category',[
            'title' => 'Category',
            'categories' => $categories
        ]);
    }

    public function add_category(Request $request)
    {
        $validator = $request->validate([
            'category' => 'required',
        ]);

        if ($validator)
        {
            $category = new Category();
            $category->cat_title = $request->category;
            $category->save();
            return redirect()->back()->with('success', 'Category Added Successfully!');
        }
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully!');
    }

    public function add_book()
    {
        $categories = Category::all();

        return view('admin.add_book',[
            'title' => 'Add Book',
            'categories' => $categories

        ]);
    }

    public function store_book(Request $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->author_name = $request->author_name;
        $book->category_id = $request->book_category;
        $book->author_name = $request->author_name;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->quantity = $request->quantity;
        $book_picture = $request->file('book_image');
        if($book_picture)
        {
            $book_picture_name = time().'.'. $book_picture->getClientOriginalName();
            $request->book_image->move('book_images', $book_picture_name);
            $book->book_image = $book_picture_name;
        }

        $author_picture = $request->file('author_image');
        if($author_picture)
        {
            $author_picture_name = time().'.'. $author_picture->getClientOriginalName();
            $request->author_image->move('author_images', $author_picture_name);
            $book->author_image = $author_picture_name;
        }

        $book->save();
        // dd($book);
        return redirect()->back()->with('success', 'Book Added Successfully!');
    }
}
