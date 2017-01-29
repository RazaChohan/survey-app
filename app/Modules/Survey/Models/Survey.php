<?php

namespace App\Modules\Survey\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Survey extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /***
     * Get User Surveys
     */
    public function getUserSurveys() {
        $userId = Auth::user()->id;
        $surveys = $this->join('survey_users as su', 'su.survey_id', '=', 'surveys.id')
                        ->where('su.user_id', '=', $userId)
                        ->get();
        return $surveys;
    }
}
