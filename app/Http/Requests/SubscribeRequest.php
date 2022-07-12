<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
          'name' => ['required', 'string', 'min:2', 'max:100'],
          'email' => 'required|string|email|max:100|unique:subscriptions',
        ];
    }

  /**
   * Get error messages for specific validation rules.
   *
   * @return array
   */

  public function messages(): array
  {
    return [
      'name.required' => 'Name is required.',
      'name.min' => 'Enter the minimum :min character.',
      'email.required' => 'Email required.',
      'email.email' => 'Please enter a valid Email.',
      'email.unique' => 'This email already exists.',
    ];
  }
}
