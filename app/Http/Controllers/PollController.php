<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Models\Poll;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::all();

        foreach($polls as $poll){
            $data[] = ['poll_id' => $poll->id, 'poll_description' => $poll->poll_description];
        }

        return response()->json([
            'total' => count($polls),
            'polls' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $poll = Poll::create([
            'poll_description' => $request->poll_description,
        ]);

        foreach($request->options as $option){
            $poll->options()->create([
                'option_description' => $option,
            ]);
        }

        return response()->json(["poll_id" => $poll->id], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poll = Poll::with('options')->find($id);

        if(!$poll){
            return response()->json(['error' => 'Poll not found'], 404);
        }

        foreach($poll->options as $option){
            $optionsArray[] = array(
                'option_id' => $option->id,
                'option_description' => $option->option_description,
            );
        }

        $poll->views += 1; //incrementando view sempre que a rota for solicitada.
        $poll->save();

        return response()->json([
            'poll_id' => $poll->id,
            'poll_description' => $poll->poll_description,
            'options' => $optionsArray,
        ], 200);
    }

    public function vote($id, Request $request)
    {
        $poll = Poll::with('options')->where('id', $id)->first();
        if(!$poll){
            return response()->json(['error' => 'Poll not found'], 404);
        }

        $option = $poll->options->where('id', $request->option_id)->first();
        if(!$option){
            return response()->json(['error' => 'Option not found'], 404);
        }

        $option->qty += 1;
        $option->save();

        return response()->json(['message' => 'Voto registrado com sucesso!']);
    }

    public function stats($id)
    {
        $poll = Poll::with('options')->find($id);

        if(!$poll){
            return response()->json(['error' => 'Poll not found'], 404);
        }

        foreach($poll->options as $option){
            $options_and_votes[] = ["option_id" => $option->id, "qty" => $option->qty];
        }

        return response()->json([
            "views" => $poll->views,
            "votes" => $options_and_votes,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $poll = Poll::find($id);

        if(!$poll){
            return response()->json(['error' => 'poll not found'], 404);
        }

        if($request->poll_description){
            $poll->poll_description = $request->poll_description;
        }

        $poll->save();

        return response()->json(['message' => 'The poll has been updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poll = Poll::find($id);

        if(!$poll){
            return response()->json(['error' => 'poll not found'], 404);
        }

        $poll->delete();
        $poll->options()->delete();

        return response()->json(['message' => 'The poll has been deleted successfully'], 200);
    }
}
