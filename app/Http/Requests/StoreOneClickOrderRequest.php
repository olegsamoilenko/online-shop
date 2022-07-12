<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOneClickOrderRequest extends FormRequest
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
          'phone' => 'required|regex:/^\+?\d{11}$/',
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
      'phone.required' => 'The Phone required.',
      'phone.regex' => 'Please enter the phone number in the format 12345678987.',
    ];
  }
}
