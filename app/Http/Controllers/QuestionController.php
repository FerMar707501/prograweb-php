<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;

class QuestionController extends Controller
{
    public function create(){
        $categories = Category::all();

        return view('questions.create',[
            'categories' => $categories,
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $question = Question::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('question.show', $question);
    }

    public function show(Question $question){

        $question->load('answers','category','user');

        return view('questions.show',[
            'question' => $question,
        ]);
    }

    public function destroy(Question $question){
        $question->delete();
        return redirect()->route('home');
    }
}

