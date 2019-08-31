<?php 

namespace App\Repositories;

use App\News;
use App\Gallery;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

/**
 * News Repository...
 */
class NewsRepository
{
	use UploadTrait;

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $reques
	 * @return bool
	 */
	public function create(Request $request) : bool
	{
		$news = new News;
        $news->title = $request->title;
        $news->description = $request->description;
        $news->body = $request->body;
        $news->user_id = auth()->user()->id;


        if ($request->has('featured_image')) {
            $news->featured_image = $this->uploadOne($request);
        }

        if(!$news->save()) {
        	return false;
        }

        if($request->has('gallery')) {
            $this->storeGallery($this->uploadToGallery($request), $news->id);    
        }

        return true;
	} 

	/**
     * Update the specified resource in storage.
	 *
	 * @param Request $reques
	 * @param \App\News $news
	 * @return bool
	 */
	public function update(Request $request, News $news) : bool
	{
        $news->title = $request->title;
        $news->description = $request->description;
        $news->body = $request->body;
        $news->user_id = auth()->user()->id;

        if ($request->has('featured_image')) {
            unlink(public_path('img/featured/') . $news->featured_image);
            $news->featured_image = $this->uploadOne($request);
        }

        if(!$news->save()) {
        	return false;
        }

        return true;
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\News $news
     * @return bool
     */
    public function delete(News $news) : bool
    {
        unlink(public_path('img/featured/') . $news->featured_image);
        
        if(!$news->delete()) {
            return false;
        }

        return true;
    }

    public function storeGallery($gallery, $news_id)
    {
        foreach ($gallery as $name) {

            \Log::info(['name' => $name]);
            Gallery::insert([
                'path' => $name,
                'news_id' => $news_id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}