<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\News\CreateRequest;
use App\Models\Group;
use App\Models\Media;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    public function news()
    {
        $news = News::with('media', 'group')
            ->select(
                DB::raw("strftime('%Y-%m-%d %H:%M', created_at) as datetime"),
                'media_id',
                'text',
                DB::raw('COUNT(*) as count'),
                DB::raw('CASE WHEN COUNT(*) = 1 THEN MAX(group_id) ELSE NULL END AS group_id')
            )
            ->groupBy('datetime', 'media_id', 'text')
            ->get();

        return $news;
    }

    public function dates(){
        $dates = News::select(DB::raw("strftime('%Y-%m-%d %H:%M', created_at) as datetime"),'text')
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();
        return $dates;
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

                ]);
            } elseif ($extension == 'mp4' || $extension == 'mov' || $extension == 'avi') {
                $media = Storage::disk('public')->put('news/videos', $file);
                $media = "storage/".$media;
                $gallery = Media::create([
                    'media' => $media,
                    'type' => 'video',
                ]);
            }
            if($data['group_id'] == 0){
                $groups = Group::select('id')->get();
                foreach ($groups as $group) {
                    News ::create([
                        'media_id' => $gallery->id,
                        'group_id' => $group->id,
                        'text' => $data['text'],
                    ]);
                }
            }

            else{
                News ::create([
                    'media_id' => $gallery->id,
                    'group_id' => $data['group_id'],
                    'text' => $data['text'],
                ]);
            }
        }

        $message = Lang::get('lang.add_news_successful');
        return $message;
    }

    public function delete($date)
    {
        $news = News::whereBetween('created_at', [$date.':00',$date.':59'])
            ->get();
        $allMedia = News::whereBetween('created_at', [$date.':00',$date.':59'])
            ->select('media_id')
            ->distinct()
            ->get();
        foreach ($news as $new) {
            $new->delete();
        }
        foreach ($allMedia as $media) {
           Media::where('id', $media->media_id)->delete();
        }
        $message = Lang::get('lang.delete_answer');
        return $message;
    }
}
