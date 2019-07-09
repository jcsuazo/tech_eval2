<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $fillable = ['title', 'year', 'imdb_number', 'poster', 'user_id'];


    public function validateInputs($request)
    {
        $request->validate([
            'title' => ['required'],
            'year' => ['required'],
            'imdb_number' => ['required'],
            'user_id' => ['required'],
        ]);
        
    }




}
