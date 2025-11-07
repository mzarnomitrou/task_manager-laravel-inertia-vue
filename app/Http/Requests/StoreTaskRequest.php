<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    
    public function rules(): array
    {
        return [
            'title'=>['string','required','max:255'],
            'status' => ['required', Rule::in(Task::STATUS_LIST)],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'due_date' => ['nullable', 'date', 'after_or_equal:today'],
            'project_id' => ['required', 'exists:projects,id'],
        ];
    }
}
