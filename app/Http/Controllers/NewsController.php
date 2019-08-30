<?php

namespace App\Http\Controllers;

use App\News;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::with('author')->orderBy('created_at', 'DESC')->paginate(10);

        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title'              =>  'required',
            'description'        =>  'required',
            'body'               =>  'required',
            'featured_image'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect('news/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $news = new News;
        $news->title = $request->title;
        $news->description = $request->description;
        $news->body = $request->body;
        $news->user_id = auth()->user()->id;

        if ($request->has('featured_image')) {
            $news->featured_image = $this->uploadOne($request);
        }

        if(!$news->save()) {
            return redirect('news/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        \Session::flash('success_message', 'News Created Successfully.');

        return redirect('news');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.show', [ 'news' => $news]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('news.edit')->with(['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $validator = \Validator::make($request->all(), [
            'title'              =>  'required',
            'description'        =>  'required',
            'body'               =>  'required',
            'featured_image'     =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect('news/updated')
                        ->withErrors($validator)
                        ->withInput();
        }

        $news->title = $request->title;
        $news->description = $request->description;
        $news->body = $request->body;
        $news->user_id = auth()->user()->id;

        if ($request->has('featured_image')) {
            unlink(public_path('img/featured/') . $news->featured_image);
            $news->featured_image = $this->uploadOne($request);
        }

        if(!$news->save()) {
            return redirect('news/update')
                        ->withErrors($validator)
                        ->withInput();
        }
        \Session::flash('success_message', 'News Updated Successfully.');

        return redirect('news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        unlink(public_path('img/featured/') . $news->featured_image);
        
        $news->delete();

        \Session::flash('success_message', 'News Deleted Successfully.');

        return redirect('news'); 
    }
}
