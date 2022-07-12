<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateOrderRequest extends FormRequest
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
          'name' => 'required|regex:/^[A-Za-z\']+$/',
          'surname' => 'required|regex:/^[A-Za-z\']+$/',
          'phone' => 'required|regex:/^\+?\d{11}$/',
          'city' => 'required|regex:/^[A-Za-z0-9.,\' ]+$/',
          'shipping' => 'required|string',
          'address' => 'required_if:shipping,addressDelivery|nullable|regex:/[?!,.a-zA-Z\s]+/',
          'post_office' => 'nullable|numeric',
          'payment' => 'required|string',
          'order_comment' => 'nullable|string',
          'no_confirmation_call' => 'required_without:noConfirmationCall|boolean',
          'status' => 'nullable|string',
          'paid' => 'nullable|boolean',
          'products' => 'array',
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
      'name.required'  => 'Name required.',
      'name.regex' => 'Please enter name correctly.',
      'surname.required' => 'Last name required.',
      'surname.regex' => 'Please enter last name correctly.',
      'phone.required' => 'Phone required.',
      'phone.regex' => 'Please enter the phone number in the format 12345678987.',
      'city.required' => 'City required.',
      'city.regex' => 'Enter city correctly.',
      'address.required' => 'Address required.',
      'address.regex' => 'Enter address correctly.',
      'post_office.required' => 'Post office number is required.',
      'address.numeric' => 'Enter post office number.',
    ];
  }
}
