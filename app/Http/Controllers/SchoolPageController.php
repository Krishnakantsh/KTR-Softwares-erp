<?php

namespace App\Http\Controllers;


class SchoolPageController extends Controller
{

    public function studentPortFolio()
    {
        return view('Frontend/Normal/Pages/Student/student_portfolio');
    }
    public function addTcBcAndCCFormat()
    {
        return view('Frontend/Normal/Pages/document_generate/build_document');
    }

    public function promoteAndDemoteStudentsView()
    {
        return view('Frontend/Normal/Pages/Student/promotion');
    }
    public function addAndUpdateStudyMaterialView()
    {
        return view('Frontend/Normal/Pages/Schools/study_material/add_and_update_study_material');
    }

    public function addAndUpdateHomeworkView()
    {
        return view('Frontend/Normal/Pages/Schools/study_material/add_homework');
    }
    public function addAndUpdatePreviousYearPapers()
    {
        return view('Frontend/Normal/Pages/Schools/study_material/add_previous_year_papers');
    }
    public function libraryAdvancedSearch()
    {
        return view('Frontend/Normal/Pages/Library/LibraryMaster/main');
    }
}
