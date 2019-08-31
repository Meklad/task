<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use App\Repositories\NewsRepository;
use App\Http\Requests\{
    CreateNewsRequest,
    UpdateNewsRequest
};
use App\Traits\UploadTrait;


class NewsController extends Controller
{
    use UploadTrait;
    
    /**
     * @var $news
     */
    public $news;

    public function __construct(NewsRepository $news_repository)
    {
        $this->middleware('auth');
        $this->_news = $news_repository;
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
     * @param  \App\Http\Requests\CreateNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNewsRequest $request)
    {
        $stateOfRecord = $this->_news->create($request);

        if($stateOfRecord == false) {
            \Session::flash('error_message', 'Error While Updateing This Record.');
            return redirect()->back();
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
     * @param  \App\Http\Requests\UpdateNewsRequest  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $stateOfRecord = $this->_news->update($request, $news);

        if($stateOfRecord == false) {
            \Session::flash('error_message', 'Error While Updateing This Record.');
            return redirect()->back();
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
        $stateOfRecord = $this->_news->delete($news);

        if($stateOfRecord == false) {
            \Session::flash('error_message', 'Error While Deleting This Record.');
            return redirect()->back();
        }

        \Session::flash('success_message', 'News Deleted Successfully.');

        return redirect('news'); 
    }
}
