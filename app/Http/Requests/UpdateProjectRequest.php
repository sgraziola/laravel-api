<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', Rule::unique('projects')->ignore($this->project->id), 'min:5', 'max:150'],
            'thumb' => 'nullable|image|max:350',
            'type_id' => 'nullable|exists:types,id',
            'language' => 'required|max:20',
            'technologies' => 'nullable|exists:technologies,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.unique' => 'Il titolo è univoco',
            'title.min' => 'Il titolo deve essere di almeno :min caratteri',
            'title.max' => 'Il titolo deve essere di :max caratteri',
            'thumb.image' => 'L\'immagine deve essere di tipo image',
            'thumb.max' => 'L\'immagine deve essere di massimo :max kilobytes',
            'language.required' => 'Il linguaggio del codice è obbligatorio',
            'language.max' => 'Il linguaggio del codice deve essere di :max caratteri',
        ];
    }
}
