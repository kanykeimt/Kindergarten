<?php

namespace App\Services\Employee;

use App\Http\Requests\Admin\News\CreateRequest;
use App\Models\Media;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    public function dates(){
        $dates = News::select(DB::raw("strftime('%Y-%m-%d %H:%M', created_at) as datetime"),'text')
            ->where('group_id', auth()->user()->group->id)
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();

        return $dates;
    }

    public function news(){
        $news = News::with('media', 'group')
            ->select(
                DB::raw("strftime('%Y-%m-%d %H:%M', created_at) as datetime"),
                'media_id',
                'text',
                DB::raw('COUNT(*) as count'),
                DB::raw('CASE WHEN COUNT(*) = 1 THEN MAX(group_id) ELSE NULL END AS group_id')
            )
            ->where('group_id', auth()->user()->group->id)
            ->groupBy('datetime', 'media_id', 'text')
            ->get();

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

            News ::create([
                'media_id' => $gallery->id,
                'group_id' => $data['group_id'],
                'text' => $data['text'],
            ]);
        }

        return Lang::get('lang.add_news_successful');
    }

    public function delete($date){
        $news = News::whereBetween('created_at', [$date.':00',$date.':59'])
            ->where('group_id', auth()->user()->group->id)
            ->get();
        foreach ($news as $new){
            Media::where('id', $new->media_id)->delete();
            $new->delete();
        }
        return Lang::get('lang.delete_answer');
    }
}
