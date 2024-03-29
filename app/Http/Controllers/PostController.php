<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json(['data' => $posts], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Post::create([
            'content' => $request->get('content'),
            //'user_id' => api('auth')->user()->id,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'content' => 'required',
        ]);

        if (!$validator->fails()) {

            $post = new Post();
            $post->content = $request->get('content');
            $isSaved = $post->save();
            if ($isSaved) {
                return response()->json(['message' => $isSaved ? "Saved successfully" : "Failed to save"], $isSaved ? 201 : 400);
            } else {
                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $id)
    {
        $this->authorize('view', $post);
        $post = Post::findOrFail($id);
        return response()->json(['data' => $post], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $validator = Validator($request->all(), [
            'content' => 'required',
        ]);

        if (!$validator->fails()) {

            $post = new Post();
            $post->content = $request->get('content');
            $isSaved = $post->save();
            if ($isSaved) {
                return response()->json(['message' => $isSaved ? "Saved successfully" : "Failed to save"], $isSaved ? 201 : 400);
            } else {
                return response()->json(['message' => "Failed to save"], 400);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $isDeleted = $post->delete();
        return response()->json(['message' => $isDeleted ? "Deleted successfully" : "Failed to delete"], $isDeleted ? 200 : 400);
    }

    // public function storeMedia(Request $request)
    // {
    //     $path = $request->file('image')->store('images', 's3');
    //     $post = Post::create([
    //         'filename' => basename($path),
    //         // 'url' => Storage::disk('s3')->url($path),
    //     ]);
    //     if (!Storage::exists($path)) {
    //         Storage::makeDirectory($path);
    //     }

    //     return $post;
    // }


    // public function showMedia(Post $post)
    // {
    //     //return Storage::disk('s3')->response('images/' . $post->filename);

    // }
}
