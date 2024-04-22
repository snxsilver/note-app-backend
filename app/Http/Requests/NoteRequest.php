<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class NoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        try {
            $token = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'category' => ['required', 'numeric', 'digits_between:0,11'],
            'title' => ['required', 'string', 'max:255'],
            // 'description' => ['nullable','string','max:65535'],
            'reminder' => ['required', 'date'],
        ];
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->responseWithErrors($validator));
    }

    protected function responseWithErrors(Validator $validator)
    {
        return response()->json($validator->errors(), 400);
    }
}
