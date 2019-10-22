<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Form $form)
    {
        //
        $fields = $form->fields->take(3);
        $submissions = $form->submissions()->latest()->get();

        return view('admin.submissions.index', compact('form', 'fields', 'submissions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Form $form, Submission $submission)
    {
        //
        return view('admin.submissions.show', compact('form', 'submission'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Form $form, Submission $submission)
    {
        //
        $submission->metas()->delete();
        $submission->delete();

        return redirect()->route('admin.submissions.index', $form)->with('success', 'Submission successfully deleted');
    }
}
