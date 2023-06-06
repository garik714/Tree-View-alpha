<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class RootContentRequest extends FormRequest
{
    public function rules() {
       return [
           //
       ];
    }

    public function getUserId()
    {
        return $this->user()->id;
    }
}
