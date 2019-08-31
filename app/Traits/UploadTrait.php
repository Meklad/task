<?php

namespace App\Traits;

use Illuminate\Http\Request;

/**
 * Handle Images Upload...
 * @author Ahmed Meklad <ahmed.meklad.news@gmail.com>
 */

trait UploadTrait
{
	/**
     * Move featured image to the public dirctory.
     *
	 * @param Illuminate\Http\Request $request
	 * @return string $imageName
	 */
    public function uploadOne(Request $request)
    {
        $image     = $request->file('featured_image');
        $name      = str_slug($request->input('title')).'_'.time();
        $imageName = $name . '-' . time().'.'.$image->getClientOriginalExtension();

        $request->featured_image->move(public_path('img/featured'), $imageName);

        return $imageName;
    }

    /**
     * Move featured image to the public dirctory.
     *
     * @param Illuminate\Http\Request $request
     * @return string $imageName
     */
    public function uploadToGallery(Request $request)
    {
        if(!empty($request->gallery)) {

            $arrayOfImagesNames = [];

            $handle = [];
            
            for ($count=0; $count < count($request->gallery); $count++) { 
                $handle['image' . $count] = $request->gallery[$count];
            }

            foreach ($handle as $name => $image) {
                $name      = str_slug($request->input('title')).'_'.time();
                
                $imageName = $name . '-' . time().'.'.$image->getClientOriginalExtension();

                $image->move(public_path('img/gallery'), $imageName);

                $arrayOfImagesNames[] = $imageName;
            }

            return $arrayOfImagesNames;
        }
    }
}