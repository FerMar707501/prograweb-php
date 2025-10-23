<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question){
        /**
         * Validate the incoming request data
         * AQUI HEMOS VALIDADO QUE EL CAMPO CONTENT ES REQUERIDO, DE TIPO STRING Y CON UN MAXIMO DE 1900 CARACTERES
         */
        $request->validate([
            'content' => 'required|string|max:1900',
        ]);

        $question->answers()->create([
            'content' => $request->content,
            'user_id' => 20,
        ]);

        return back();
    }
}
