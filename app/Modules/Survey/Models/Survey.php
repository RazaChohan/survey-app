<?php

namespace App\Modules\Survey\Models;

use Illuminate\Database\Eloquent\Model;


class Survey extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}