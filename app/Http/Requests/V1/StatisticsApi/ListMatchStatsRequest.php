<?php

namespace App\Http\Requests\V1\StatisticsApi;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ListMatchStatsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|string>
     */
    public function rules(): array
    {
        return [
            'param_id' => 'nullable|exists:match_stats,param_id',
            'year' => 'required|integer|between:2011,' . now()->year,
            'page' => 'integer',
            'length' => 'integer|in:25,50'
        ];
    }
}
