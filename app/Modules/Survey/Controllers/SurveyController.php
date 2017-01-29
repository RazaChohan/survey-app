<?php

namespace App\Modules\Survey\Controllers;

use App\Modules\Survey\Models\Survey;

use App\Modules\Survey\Models\SurveyAttribute;
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
    public function index() {
        $survey = $this->surveyModel->getUserSurveys();
        return view('Survey::index')->with(['surveys' => $survey]);
    }

    /***
     * Fill Form (Get Method)
     *
     * @param $id
     * @return View fill survey form
     */
    public function fillForm($id) {
        $survey = $this->surveyModel->getSurveyInfo($id);
        return view('Survey::fill')->with(['survey' => $survey]);
    }

    /***
     * View Form (Get Method)
     *
     * @param $id
     *
     * @return view view filled survey form
     */
    public function viewForm($id) {
        $survey = $this->surveyModel->getFilledSurvey($id);
        return view('Survey::view')->with(['survey' => $survey]);
    }

    /***
     * Save or submit survey
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveForm() {
        $surveyId = $this->request->get('survey_id');
        $surveySaveMethod = $this->request->get('method','Save');
        $surveyAttributeModel = new SurveyAttribute();
        $formDataValues = $this->request->all();
        $surveyAttributeSubmissions = [];
        foreach ($formDataValues as $key => $value) {
            if(preg_match('/^[a-zA-z0-9]+\_\d+$/i', $key)) {
                $extractedFieldInfo = explode('_', $key);
                $extractedId = intval($extractedFieldInfo[(sizeof($extractedFieldInfo) - 1)]);
                $surveyAttributeSubmissions[$extractedId] = is_array($value) ? implode(',', $value) : $value;
            }
        }
        $surveyAttributeModel->addOrUpdateAttributeSubmission($surveyAttributeSubmissions);
        $this->surveyModel->updateUserSurveyStatus($surveyId, $surveySaveMethod);
        $successMessage = ($surveySaveMethod == 'submit') ? 'Survey Submitted Successfully' : 'Survey Saved Successfully';
        return redirect()->route('survey-list')->with('success', $successMessage);
    }
}
