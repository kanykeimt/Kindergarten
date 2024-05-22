<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Gallery\CreateRequest;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class GalleryService
{

    public function dates(){
        $dates = Gallery::select(DB::raw("strftime('%Y-%m-%d %H:%M', created_at) as datetime"))
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();
        return $dates;
    }

    public function galleries(){
        $galleries = Gallery::all();
        return $galleries;
    }
    public function create(CreateRequest $request){
        $data = $request->validated();
        if (!Storage::exists('public/gallery/photos')) {
            Storage::makeDirectory('public/gallery/photos');
        }
        if (!Storage::exists('public/gallery/videos')) {
            Storage::makeDirectory('public/gallery/videos');
        }

        foreach ($data['media'] as $file) {
            $extension = $file->getClientOriginalExtension();
            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                $media = Storage::disk('public')->put('gallery/photos', $file);
                $media = "storage/" . $media;
                Gallery::create([
                    'media' => $media,
                    'type' => 'image',
                ]);
            }
            elseif ($extension == 'mp4' || $extension == 'mov' || $extension == 'avi') {
                $media = Storage::disk('public')->put('gallery/videos', $file);
                $media = "storage/" . $media;
                Gallery::create([
                    'media' => $media,
                    'type' => 'video',
                ]);
            }
        }

        return Lang::get('lang.add_gallery_successful');
    }

    public function delete($date){
        $galleries = Gallery::whereBetween('created_at', [$date.':00',$date.':59'])->get();
        foreach ($galleries as $gallery) {
            $gallery->delete();
        }
        return Lang::get('lang.delete_answer');
    }
}
