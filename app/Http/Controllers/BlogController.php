<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * ブログ登録画面を表示する
     *
     * @return view
     */
    public function showCreate() {
        return view('blog.form');
    }

    /**
     * ブログを登録する
     *
     * @return view
     */
    public function exeStore(BlogRequest $request)
    {
        $inputs = $request->all();

        DB::beginTransaction();
        try {
            Blog::create($inputs);
            DB::commit();
        } catch(\Throwable $e) {
            DB::rollBack();
            abort(500);
        }

        $request->session()->flash('err_msg', 'ブログを登録しました');
        return redirect(route('blogs'));
    }

    /**
     * ブログ編集フォームを表示する
     * @param int $id
     *
     * @return view
     */
    public function showEdit($id, Request $request)
    {
        $blog = Blog::find($id);

        if (is_null($blog)) {
            $request->session()->flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }

        return view('blog.edit', ['blog' => $blog]);
    }

    /**
     * ブログを更新する
     *
     * @return view
     */
    public function exeUpdate(BlogRequest $request)
    {
        $inputs = $request->all();

        DB::beginTransaction();
        try {
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $blog->save();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            abort(500);
        }

        $request->session()->flash('err_msg', 'ブログを更新しました');
        return redirect(route('blogs'));
    }

    /**
     * ブログ削除
     * @param int $id
     *
     */
    public function exeDelete($id, Request $request)
    {
        $blog = Blog::find($id);

        if (is_null($blog)) {
            $request->session()->flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }

        DB::beginTransaction();
        try {
            Blog::destroy($id);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            abort(500);
        }

        $request->session()->flash('err_msg', '記事番号：'.$id.'を削除しました。');
        return redirect(route('blogs'));
    }
}
