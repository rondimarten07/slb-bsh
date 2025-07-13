<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\User;
use App\Services\StudentFuzzyEvaluator;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $selectedMonth = $request->input('month') ?: Carbon::now()->format('Y-m');

        // Get the start and end dates of the month
        $startOfMonth = Carbon::create($selectedMonth)->startOfMonth();
        $endOfMonth = Carbon::create($selectedMonth)->endOfMonth();

        // Fetch students and their attendance
        // $students = Student::with(['attendance' => function ($query) use ($startOfMonth, $endOfMonth) {
        //     $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        // }])->get();

        $user = Auth::user();
                
        $members = User::all();
        if ($user->hasRole('teacher')) { 
            $members = User::role(['student', 'teacher'])->where('classroom', $user->classroom);
        }

        if ($user->hasRole('staff')) {
            $members = User::role(['student', 'staff', 'teacher']);
        }

        if ($user->hasRole('admin')) {
            $members = User::role(['student', 'staff']);
        }

        $students = User::whereIn('id', $members->pluck('id'))->with(['presences' => function ($query) use ($selectedMonth) {
            $startOfMonth = Carbon::create($selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::create($selectedMonth)->endOfMonth();
            $query->whereDate('date', '>=', $startOfMonth)
                  ->whereDate('date', '<=', $endOfMonth);
        }])->get();

        // Get all dates in the selected month
        $datesInMonth = [];
        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            $datesInMonth[] = $date->copy();
        }

        // Pass the data to the view
        $pdf = Pdf::loadView('attendance-sheet-pdf', [
            'students' => $students,
            'datesInMonth' => $datesInMonth,
            'selectedMonth' => $selectedMonth,
        ])->setPaper('f4', 'landscape');;

        // Download the PDF file
        return $pdf->download('attendance-sheet-' . $selectedMonth . '.pdf');
    }

    public function generateReportPDF(Request $request, int $id)
    {
        $evaluator = new StudentFuzzyEvaluator();

        $attitudeScore = 100;

        $score = Score::find($id);

        $groupA = [
            'religion',
            'nation',
            'indonesia',
            'math',
            'english',
            'science',
            'social',
        ];

        $groupB = [
            'art',
            'sport',
            'local_wisdom',
        ];

        $groupC = [
            'interest',
        ];

        $groupD = [
            'independence',
        ];

        $groupE = [
            'extraordinary',
        ];


        $sum = 0;
        $count = 0;

        for($i = 0; $i < count($groupA); $i++) {
            $sum += $score[$groupA[$i] . '_knowledge'];
            $count++;
        }
        for($i = 0; $i < count($groupB); $i++) {
            $sum += $score[$groupB[$i] . '_knowledge'];
            $count++;
        }
        for($i = 0; $i < count($groupC); $i++) {
            $sum += $score[$groupC[$i] . '_knowledge'];
            $count++;
        }
        for($i = 0; $i < count($groupD); $i++) {
            $sum += $score[$groupD[$i] . '_knowledge'];
            $count++;
        }
        for($i = 0; $i < count($groupE); $i++) {
            $sum += $score[$groupE[$i] . '_knowledge'];
            $count++;
        }
        $knowledgeScore = $sum / $count;

        $sum = 0;
        $count = 0;
        for($i = 0; $i < count($groupA); $i++) {
            $sum += $score[$groupA[$i] . '_skill'];
            $count++;
        }
        for($i = 0; $i < count($groupB); $i++) {
            $sum += $score[$groupB[$i] . '_skill'];
            $count++;
        }
        for($i = 0; $i < count($groupC); $i++) {
            $sum += $score[$groupC[$i] . '_skill'];
            $count++;
        }
        for($i = 0; $i < count($groupD); $i++) {
            $sum += $score[$groupD[$i] . '_skill'];
            $count++;
        }
        for($i = 0; $i < count($groupE); $i++) {
            $sum += $score[$groupE[$i] . '_skill'];
            $count++;
        }
        $skillScore = $sum / $count;

        
        // Pass the data to the view
        $pdf = Pdf::loadView('student-report-pdf', [
            'score' => $score,
            'evaluationResult' => $evaluator->evaluate($attitudeScore, knowledgeScore: $knowledgeScore, skillScore: $skillScore)
        ])->setPaper('a4', 'portrait');

        // Download the PDF file
        return $pdf->download('rapor-siswa.pdf');
    }

    public function generatePaycheckPDF(Request $request)
    {
        
        // Pass the data to the view
        $pdf = Pdf::loadView('pdf.paycheck-pdf', [
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'period' => $request->input('period'),
            'base' => $request->input('base'),
            'transport' => $request->input('transport'),
            'meal' => $request->input('meal'),
            'gross' => $request->input('gross'),
            'bpjs' => $request->input('bpjs'),
            'loan' => $request->input('loan'),
            'deduction' => $request->input('deduction'),
            'netto' => $request->input('netto'),
        ])->setPaper('a4', 'portrait');

        // Download the PDF file
        return $pdf->download('slip-gaji.pdf');
    }
}
