<?php

namespace App\Modules\Survey\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyAttribute extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
