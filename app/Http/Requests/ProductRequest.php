<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ProductRequest extends FormRequest
{
    /**
     * @var Validator
     */
    public $validator;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'attributes' => ['nullable', 'array'],
            'attributes.*.key' => ['required', 'string'],
            'attributes.*.value' => ['required', 'string']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $this->validator = $validator;
    }
}
