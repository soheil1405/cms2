<?php

namespace App\Http\Controllers\API\V01\Thread;

use App\Http\Controllers\Controller;
use App\Models\Threads;
use App\Repositories\ThreadRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\FlareClient\Http\Response as HttpResponse;

class ThreadController extends Controller
{

    public function index()
    {
        
        $threads =resolve(ThreadRepository::class)->getAllAvailableThreads();
        return response()->json($threads , Response::HTTP_OK);
  
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate(
            
        [
           'title'=>['required'],
           'content'=>['required'],
           'channel_id'=>['required'],

        ]
    );


        resolve(ThreadRepository::class)->StoreThread($request);

        return response()->json([
            'massage'=>'Thread Creted Successfully'
        ]  , Response::HTTP_CREATED);





    }


    public function show($slug)
    {
        $threads = resolve(ThreadRepository::class)->getThreadBySlug($slug);
        return response()->json($threads , Response::HTTP_OK);
    }






    public function update( Request $request , Threads $thread)
    {

        $request->validate(
            
            [
               'title'=>['required'],
               'content'=>['required'],
               'channel_id'=>['required'],
    
            ]
        );

        $thread = resolve(ThreadRepository::class)->UpdateThreads($request , $thread);
        return response()->json([
            'massage'=>'Thread Updated Successfuklly'
        ] , Response::HTTP_OK);
    }



    public function destroy($id)
    {
        resolve(ThreadRepository::class)->DestroyThreads($id);
        return response()->json([
            'massage'=>'Thread Deleted Successfuklly'
        ] , Response::HTTP_OK);
    }
}
