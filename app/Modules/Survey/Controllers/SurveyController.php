<?php

namespace App\Modules\Survey\Controllers;

use App\Modules\Survey\Models\Survey;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Routing\Controller;

class SurveyController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Survey Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling survey related requests
      |
      */

    /***
     * Request object for dependency injection
     *
     * @var
     */
    private $request;
    /***
     * Survey Model for dependency injection
     * @var
     */
    private $surveyModel;

    /***
     * Constructor
     *
     * @param Request $request
     * @param Survey $surveyModel
     */
    public function __construct(Request $request, Survey $surveyModel)
    {
        $this->request = $request;
        $this->surveyModel = $surveyModel;
    }

    /**
     *List surveys
     *
     * @return View listing of surveys
     */
    public function index()
    {
        $survey = $this->surveyModel->getUserSurveys();
        return view('Survey::index')->with(['surveys' => $survey]);
    }
}
