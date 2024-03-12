<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdeaContrller extends Controller
{
    public function index():View{

        $ideas = Idea::get();
        return view('ideas.index',['ideas'=>$ideas]);
    }


    public function create():View{
        return view('ideas.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' =>'required|string|max:100',
            'description' =>'required|string|max:300'
        ]);

        Idea::create([
            'title' =>$validated['title'],
            'description' => $validated['description'],
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('idea.index');
    }
}
