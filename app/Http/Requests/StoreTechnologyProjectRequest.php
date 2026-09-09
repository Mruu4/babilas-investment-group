<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTechnologyProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['Super Admin', 'Content Manager', 'Investment Manager']);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'sector' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'investment_stage' => ['nullable', 'string', 'max:100'],
            'investment_information' => ['nullable', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'status' => ['required', 'in:Active,Completed,Planned,On Hold'],
            'is_featured' => ['nullable', 'boolean'],
            'media' => ['nullable', 'array'],
            'media.*' => ['file', 'mimes:jpg,jpeg,png,webp,mp4,webm,pdf', 'max:10240'],
        ];
    }
}
