<?php

namespace App\Http\Controllers;


class SchoolPageController extends Controller
{

    public function studentPortFolio()
    {
        return view('School.Pages.Student/student_portfolio');
    }
    public function addTcBcAndCCFormat()
    {
        return view('School.Pages.document_generate/build_document');
    }

    public function promoteAndDemoteStudentsView()
    {
        return view('School.Pages.Student/promotion');
    }
    public function addAndUpdateStudyMaterialView()
    {
        return view('School.Pages.Schools/study_material/add_and_update_study_material');
    }

    public function addAndUpdateHomeworkView()
    {
        return view('School.Pages.Schools/study_material/add_homework');
    }
    public function addAndUpdatePreviousYearPapers()
    {
        return view('School.Pages.Schools/study_material/add_previous_year_papers');
    }
    public function libraryAdvancedSearch()
    {
        return view('School.Pages.Library/LibraryMaster/main');
    }
}
