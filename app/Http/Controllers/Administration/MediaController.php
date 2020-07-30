<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\MediaStream;


class MediaController extends Controller
{
    public function index()
    {
        $medias = Auth::guard('admin')->user()
            ->getMedia('avatar');
        return view('administration.pages.media')->with([
            'medias' => $medias,
        ]);;
    }

    public function media_upload(Request $request)
    {
//        dd($request->images);
        foreach ($request->images as $image) {
            Auth::guard('admin')->user()
                ->addMedia($image)
                ->preservingOriginal()
                ->toMediaCollection('avatar');
        }
        return redirect()->route('admin.media.get');
    }

    public function media_get(Request $request)
    {
        $medias = Auth::guard('admin')->user()
            ->getMedia('avatar');

        return view('administration.pages.media')->with([
            'medias' => $medias,
        ]);
    }

    public function media_delete(Media $media)
    {
        $media->delete();
        return redirect()->route('admin.media.get')->with('success', 'media deleted successfully');
    }

    public function media_download(Media $media)
    {
        return $media;
    }

    public function media_download_all()
    {
        $downloads = Auth::guard('admin')->user()->getMedia();
        return MediaStream::create('my-files.zip')->addMedia($downloads);
    }

    public function media_update(Media $media)
    {
        $user = Auth::guard('admin')->user();
        $user->avatar_id = $media->id;
        $user->update();

        return redirect()->route('admin.media.get');
    }


}
