<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Form;
use App\Models\FormQuestion;
use Illuminate\Http\Request;
use App\Models\QuestionOption;
use Illuminate\Support\Facades\Auth;

class FormsController extends Controller
{
    public function create()
    {
        // Show form creation page with empty form data
        return view('forms.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'questions' => 'required|array|min:1',
            //  'questions.type' => 'required|string|in:text,number,date,single_choice',
            //'questions.*.question' => 'required|string|max:255',
            //'questions.*.is_required' => 'required|boolean',
            //'questions.*.options' => 'nullable|array',
            //'questions.*.options.*' => 'nullable|string',
        ]);
        // dd($validatedData);
        $validatedData['user_id'] = Auth::user()->id;
        $form = new Form($validatedData);
        $form->save();

        foreach ($validatedData['questions'] as $questionData) {
            $question = new FormQuestion([
                'form_id' => $form->id,
                'type' => $questionData['type'],
                'question' => $questionData['question'],
                'is_required' => $questionData['is_required'],
            ]);
            $question->save();

            if ($questionData['type'] === 'single_choice') {
                foreach ($questionData['options'] as $option) {

                    $v = new QuestionOption(['form_question_id' => $question->id, 'option' => $option]);
                    $v->save();
                }
            }
        }

        return redirect()->route('forms.index', ['form' => $form]);
    }



    public function index()
    {

        $forms = Form::where('user_id', Auth::user()->id)->get();
        return view('forms.index', compact('forms'));
    }
}
