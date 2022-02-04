<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * ブログ一覧を表示する
     *
     * @return view
     */
    public function showList()
    {
        $blogs = Blog::all();

        // dd($blogs);

        return view('blog.list', ['blogs' => $blogs]);
    }

    /**
     * ブログ詳細を表示する
     * @param int $id
     *
     * @return view
     */
    public function showDetail($id, Request $request)
    {
        $blog = Blog::find($id);

        if (is_null($blog)) {
            $request->session()->flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }

        return view('blog.detail', ['blog' => $blog]);
    }
}
