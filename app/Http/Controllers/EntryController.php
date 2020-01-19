<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;
use App\Http\Resources\EntryResource as EntryResource;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('vueApp');
    }
    public function index()
    {
        $entries = Entry::paginate(15);

        //return collection as a resource
        return EntryResource::collection($entries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        $entry = new Entry;
        $entry->user_id = $request->user()->id;
        // $entry->user_id = $request->user_id; 
        $entry->title = $request->title;
        $entry->body = $request->body;
        $entry->save();

        return new EntryResource($entry);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(entry $entry)
    {
        return new EntryResource($entry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)

    {

      // check if currently authenticated user is the owner of the entry

      if ($request->user()->id !== $entry->user_id) {

        return response()->json(['error' => 'You can only edit your own entries.'], 403);

      }



      $entry->update($request->only(['title', 'body']));



      return new EntryResource($entry);
    }

  
}
