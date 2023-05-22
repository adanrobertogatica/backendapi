<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ProductCategory;
use Illuminate\Validation\Rules\Enum;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'required',
            'brand' => 'required',
            'price' => ['required','decimal:0,2'],
            'price_sale' => ['required','decimal:0,2'],
            'category' => [new Enum(ProductCategory::class)],
            'stock' => ['required','numeric'],
        ];
    }
}
