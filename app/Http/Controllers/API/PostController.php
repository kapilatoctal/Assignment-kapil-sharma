<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostResourceCollection;

class PostController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->authorizeResource(Post::class, 'posts');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try
        {
        $this->authorize('viewAny',Post::class);

            $posts = Post::when($request->hasHeader('withCategory') && $request->hasHeader('withTags'), function ($query){
                $query->with(['category.childs','tags']);
            })->when($request->hasHeader('withCategory'), function ($query){
                $query->with(['category.childs']);
            })->when($request->hasHeader('withTags'), function ($query){
                $query->with(['tags']);
            })->get();

            return $posts ?
              new PostResourceCollection($posts)
            : response()->json(['message' => 'No results found'],404);

            } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],500);
        }
    }

    // To display single post data By Slug

    public function show(Request $request,$slug)
    {
        try
        {
        if(Post::whereSlug($slug)->exists()){
        $this->authorize('view', Post::whereSlug($slug)->first());
        $post = Post::when($request->hasHeader('withCategory') && $request->hasHeader('withTags'), function ($query){
            $query->with(['category.childs.parent','tags']);
        })->when($request->hasHeader('withCategory'), function ($query){
            $query->with(['category.childs.parent']);
        })->when($request->hasHeader('withTags'), function ($query){
            $query->with(['tags']);
        })->whereSlug($slug)->first();
        // dd($post);

        return  new PostResource($post);
        }else{
            return response()->json(['message' => 'record not found'],404);
        }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],500);
        }
    }

    public function showById(Request $request,Post $post)
    {   try
        {
        $this->authorize('view', $post);
        $post = Post::when($request->hasHeader('withCategory') && $request->hasHeader('withTags'), function ($query){
            $query->with(['category:id,name,parent,childs,','tags']);
        })->when($request->hasHeader('withCategory'), function ($query){
            $query->with(['category']);
        })->when($request->hasHeader('withTags'), function ($query){
            $query->with(['tags']);
        })->find($post->id);

        return  $post ?
        new PostResource($post)
        : response()->json(['message' => 'record not found'],404);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],500);
        }
    }


    // To display single post data

    public function update(Request $request,$slug)
    {
        try
        {
        $this->authorize('update', Post::whereSlug($slug)->first());
        $post = Post::whereSlug($slug)->with(['category','tags'])->first();

        return  $post ?
        new PostResource($post)
        : response()->json(['message' => 'record not found'],404);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],500);
        }
    }



    public function destroy($slug)
    {
        try
        {
        $this->authorize('delete', Post::whereSlug($slug)->first());
        dd('in');
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],500);
        }
    }

}
