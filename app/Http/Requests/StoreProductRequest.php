<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
      'title' => 'required|string|min:2|max:100|unique:products',
      'description' => 'required|string',
      'price' => 'required|numeric',
      'old_price' => 'nullable|numeric',
      'category_id' => 'integer',
      'tags' => 'required',
      'emotion' => 'nullable|string',
      'volume' => 'nullable|numeric',
      'diameter' => 'nullable|numeric',
      'height' => 'nullable|numeric',
      'color' => 'required|string',
      'material' => 'required|string',
      'made_by' => 'required|string',
      'is_available' => 'boolean',
      'is_active' => 'boolean',
      'images' => function ($atr, $val, $fail) {
        if ($val === "false") {
          return $fail('Add at least one image');
        } else {
          foreach ($val as $v) {
            if ($v->getClientMimeType() !== 'image/png' && $v->getClientMimeType() !== 'image/jpg' && $v->getClientMimeType() !== 'image/jpeg') {
              return $fail('Incorrect file format');
            }
          }
        }
      },
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
      'title.required' => 'Enter product title.',
      'title.min' => 'Enter the minimum :min character.',
      'title.max' => 'Title must not exceed :max characters.',
      'title.unique' => 'This product has already been added.',
      'description.required' => 'Write a full product description.',
      'price.required' => 'Price is required.',
      'price.numeric' => 'Enter the correct price.',
      'old_price.numeric' => 'Enter the correct price.',
      'category_id.integer' => 'Select a category.',
      'tags.required' => 'Select tags',
      'images.required' => 'Add at least one image',
      'images.mimes' => 'Incorrect image format',

    ];
  }
}
