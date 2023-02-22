<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Exception;
use App\Section;
use App\Subject;
use App\Category;
use App\Question;
use App\Evaluation;
use App\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:student');
    }

    public function index()
    {
        $faculties = User::role('Faculty')->paginate(5);
        return view('evaluations.index',compact('faculties'));
    }

    public function myevaluation()
    {
        $evaluations = Evaluation::where('evaluator_id', Auth::user()->id)->latest()->paginate(5);
        return view('evaluations.my-evaluations',compact('evaluations'));
    }

    public function create(User $faculty)
    {
        $sections = Section::all();
        $subjects = Subject::all();

        $categories = Category::with([
            'questions' => function ($query) {
                $query->where('status', 1);
            }
        ])->get();

        return view('evaluations.create',compact('sections', 'subjects', 'faculty', 'categories'));
    }

    public function store(Request $request, User $faculty, Subject $subject)
    {
        // dd($request->all());
      
        $request->validate([
            'section_id' => 'required',
            'subject_id' => 'required',
            'rates' => 'required|array',
            'rates.*' => 'required|integer',
        ]);

        try
        {
            DB::beginTransaction();

            $input = $request->all();
            $input['faculty_id'] = $faculty->id;
            $input['academic_year'] = AcademicYear::latest()->first()->name;

            $rates = collect($request->rates)->map(function ($value, $key) {
                return ['rate' => $value ];
            })->toArray();

            $evaluation = Auth::user()->evaluations()->create($input);

            $evaluation->questions()->sync($rates);

            DB::commit();

        }
        catch(Exception $e)
        {
            DB::rollBack();
            return back()->withErrors(['error' => 'Contact Administrator']);
        }

        return redirect()->route('evaluations')->with('success','Success!');
    }

    public function show(Evaluation $evaluation)
    {
        $categories = $evaluation->questions->loadMissing(['category'])->mapToGroups(function ($value, $key) {
            return [$value['category']['name'] => $value];
        });

        return view('evaluations.show', compact('evaluation', 'categories'));
    }
}
