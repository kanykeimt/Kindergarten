<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\News\CreateRequest;
use App\Models\Group;
use App\Models\Media;
use App\Models\News;
use App\Models\NewsAddress;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    public function news()
    {
        $news = News::with(['group', 'media']) // Eager loading relationships
        ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
        dd($news);
        return $news;
    }
    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        if (!Storage::exists('public/news/photos')) {
            Storage::makeDirectory('public/news/photos');
        }
        if (!Storage::exists('public/news/videos')) {
            Storage::makeDirectory('public/news/videos');
        }

        foreach ($data['media'] as $file) {
            $extension = $file->getClientOriginalExtension();
            $gallery = new Media();
            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                $media = Storage::disk('public')->put('news/photos', $file);
                $media = "storage/".$media;
                $gallery = Media::create([
                    'media' => $media,
                    'type' => 'image',
                    'text' => $data['text'],
                ]);
            } elseif ($extension == 'mp4' || $extension == 'mov' || $extension == 'avi') {
                $media = Storage::disk('public')->put('news/videos', $file);
                $media = "storage/".$media;
                $gallery = Media::create([
                    'media' => $media,
                    'type' => 'video',
                    'text' => $data['text'],
                ]);
            }
            if($data['group_id'] == 0){
                $groups = Group::select('id')->get();
                foreach ($groups as $group) {
                    News ::create([
                        'media_id' => $gallery->id,
                        'group_id' => $group->id,
                    ]);
                }
            }

            else{
                News ::create([
                    'media_id' => $gallery->id,
                    'group_id' => $data['group_id'],
                ]);
            }
        }

        $message = Lang::get('lang.add_news_successful');
        return $message;
    }
}
