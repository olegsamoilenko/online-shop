<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateOneClickOrderRequest extends FormRequest
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
          'name' => 'required|regex:/^[A-Za-z]+$/',
          'surname' => 'required|regex:/^[A-Za-z]+$/',
          'phone' => 'required|regex:/^\+?\d{11}$/',
          'city' => 'required_if:shipping,addressDelivery|required_if:shipping,toYourPostOffice|nullable|regex:/^[A-Za-z., ]+$/',
          'shipping' => 'required|string',
          'address' => 'required_if:shipping,addressDelivery|nullable|regex:/^[A-Za-z0-9., ]+$/',
          'post_office' => 'required_if:shipping,toYourPostOffice|nullable|numeric',
          'payment' => 'required|string',
          'order_comment' => 'nullable|string',
          'status' => 'nullable|string',
          'paid' => 'nullable|boolean',
          'products' => 'array',
        ];
    }

  /**
   * convert to underscore case
   *
   * @return array
   */

  public function snakeCase() {
    $result = $this->validated();
    $data = [];
    foreach ($result as $key => $value) {
      $data[Str::snake($key, '_')] = $value;
    }
    return $data;
  }

  /**
   * Get error messages for specific validation rules.
   *
   * @return array
   */

  public function messages(): array
  {
    return [
      'name.required'  => 'The Name required.',
      'name.regex' => 'Please enter name correctly.',
      'surname.required' => 'The Last name required.',
      'surname.regex' => 'Please enter last name correctly.',
      'phone.required' => 'The Phone required.',
      'phone.regex' => 'Please enter the phone number in the format 12345678987.',
      'city.required' => 'The City required.',
      'shipping.required' => 'The Delivery field is required.',
      'payment.required' => 'The Payment field is required.',
      'city.regex' => 'Enter city correctly.',
      'address.required' => 'The Address required.',
      'address.regex' => 'Enter address correctly.',
      'post_office.required' => 'The Post office number is required.',
      'address.numeric' => 'Enter post office number.',
    ];
  }
}
