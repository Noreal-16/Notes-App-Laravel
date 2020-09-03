<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::with('category') -> get();
        return $notes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion de campos
        $data =$request ->validate([
            'body' => 'required|max:350|unique:notes,body',
            'category_id' => 'required|exists:categories,id'
        ]);
        $note = new Note;
        $note -> body = $data['body'];
        $note -> category_id = $data['category_id'];
        $note -> save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //validacion de campos
        $data =$request ->validate([
            'body' => 'required|max:350|unique:notes,body,'. $note->id,
            'category_id' => 'required|exists:categories,id'
        ]);
        $note -> body = $data['body'];
        $note -> category_id = $data['category_id'];
        $note -> save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note-> delete();
    }
}
