<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function create(){
        $categories = Category::all();

        return view('questions.create',[
            'categories' => $categories,
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
        ]);

        $question = Question::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('question.show', $question)
            ->with('success', 'Pregunta creada exitosamente');
    }

    public function show(Question $question){

        $question->load('answers','category','user');

        return view('questions.show',[
            'question' => $question,
        ]);
    }

    public function edit(Question $question){
        // Verificar que el usuario autenticado sea el dueño de la pregunta
        if (auth()->id() !== $question->user_id) {
            abort(403, 'No tienes permiso para editar esta pregunta');
        }

        $categories = Category::all();

        return view('questions.edit',[
            'question' => $question,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Question $question){
        // Verificar que el usuario autenticado sea el dueño de la pregunta
        if (auth()->id() !== $question->user_id) {
            abort(403, 'No tienes permiso para editar esta pregunta');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
        ]);

        $question->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
        ]);

        return redirect()
            ->route('question.show', $question)
            ->with('success', 'Pregunta actualizada exitosamente');
    }

    public function destroy(Question $question){
        // Verificar que el usuario autenticado sea el dueño de la pregunta
        if (auth()->id() !== $question->user_id) {
            abort(403, 'No tienes permiso para eliminar esta pregunta');
        }

        $question->delete();

        return redirect()
            ->route('home')
            ->with('success', 'Pregunta eliminada exitosamente');
    }
}

