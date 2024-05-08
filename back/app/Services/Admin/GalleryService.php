<?php

namespace App\Services\Admin;

use App\Models\Gallery;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    public function store(Request $request, Group $group)
    {
        $data = $request->validate([
            'info' => ''
        ]);
        if($request->has('images')){
            foreach ($request->file('images') as $image) {
                $imageName = Storage::disk('public')->put('group_gallery', $image);
                $imageName = "storage/".$imageName;

                Gallery::create([
                    'group_id'=>$group->id,
                    'image'=>$imageName,
                    'video'=>null,
                    'info'=>$data['info']
                ]);
            }
        }
        if($request->has('videos')){
            foreach ($request->file('videos') as $video) {
                $videoName = Storage::disk('public')->put('group_gallery', $video);
                $videoName = "storage/".$videoName;
                Gallery::create([
                    'group_id'=>$group->id,
                    'image'=>null,
                    'video'=>$videoName,
                    'info' => $data['info']
                ]);
            }
        }
        return ['message' => 'ok'];
    }
}
