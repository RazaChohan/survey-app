<?php

namespace App\Modules\Survey\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;
class Survey extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /***
     * One to many relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function surveyAttributes() {
        return $this->hasMany('App\Modules\Survey\Models\SurveyAttribute', 'survey_id', 'id');
    }
    /***
     * Get User Surveys
     *
     * @return surveys
     */
    public function getUserSurveys() {
        $userId = Auth::user()->id;
        $surveys = $this->join('survey_users as su', 'su.survey_id', '=', 'surveys.id')
                        ->where('su.user_id', '=', $userId)
                        ->get();
        return $surveys;
    }

    /***
     * Get Survey info
     *
     * @param $surveyId
     * @return survey
     */
    public function getSurveyInfo($surveyId) {
        $survey = $this->with(['surveyAttributes' => function($query) {
                            $query->with('surveySubmissions');
                       }])
                       ->join('survey_users as su', 'su.survey_id', '=', 'surveys.id')
                       ->where('su.user_id', '=', Auth::user()->id)
                       ->where('su.survey_id', '=', $surveyId)
                       ->first();
        return $survey;
    }

    /***
     * Update Survey Records for specific user
     *
     * @param $surveyId
     * @param $surveySaveMethod
     */
    public function updateUserSurveyStatus($surveyId, $surveySaveMethod) {
        DB::table('survey_users')
                ->where('user_id', '=', Auth::user()->id)
                ->where('survey_id', '=', $surveyId)
                ->update(['status' => ($surveySaveMethod == 'submit') ? 'Completed' : 'Partially Completed']);
    }

    public function getFilledSurvey($surveyId) {

    }
}
