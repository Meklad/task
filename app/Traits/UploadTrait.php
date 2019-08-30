<?php

namespace App\Traits;

trait UploadTrait
{
    public function uploadOne($request)
    {
        $image    = $request->file('featured_image');
        $name     = str_slug($request->input('title')).'_'.time();
        $imageName = $name . '-' . time().'.'.$image->getClientOriginalExtension();
        $request->featured_image->move(public_path('img/featured'), $imageName);
        return $imageName;
    }
}