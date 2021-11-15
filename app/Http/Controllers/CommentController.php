<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Auth;
use Gate;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
    
        return view('comments.index', ['comments' => $comments]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Recipe $recipe)
    {
        return view('comments.create',['recipe' => $recipe]) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Recipe $recipe)
    {
        if (! Gate::allows('Recipe-in-my-cookbook', $recipe)) {
            abort(403);
        }
        
        request()->validate([
            'comment' => 'required',
        ]);
      
        $comment = new Comment();
        $comment->comment = request('comment');
        $comment->recipe_id =  $recipe->id;
        $comment->user_id =  Auth::user()->id;
        $comment->save();

        return redirect("/recipes/$recipe->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe, Comment $comment)
    {
       return view('comments.show', ['comment' => $comment]) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe, Comment $comment)
    {
        $comment->delete();
        return redirect("recipes/$recipe->id");
    }
}
