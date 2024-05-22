<?php

namespace App\Services\User;

use App\Models\News;
use Illuminate\Support\Facades\DB;

class ChildService
{
    public function dates($child){
        $dates = News::select(DB::raw("strftime('%Y-%m-%d %H:%M', created_at) as datetime"),'text')
            ->where('group_id', $child->group->id)
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();

        return $dates;
    }

    public function news($child){
        $news = News::with('media', 'group')
            ->select(
                DB::raw("strftime('%Y-%m-%d %H:%M', created_at) as datetime"),
                'media_id',
                'text',
                DB::raw('COUNT(*) as count'),
                DB::raw('CASE WHEN COUNT(*) = 1 THEN MAX(group_id) ELSE NULL END AS group_id')
            )
            ->where('group_id', $child->group->id)
            ->groupBy('datetime', 'media_id', 'text')
            ->get();

        return $news;
    }
}
