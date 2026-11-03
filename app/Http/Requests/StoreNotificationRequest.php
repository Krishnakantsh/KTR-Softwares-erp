<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // gate this behind admin middleware at route level
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:150'],
            'body'         => ['required', 'string', 'max:1000'],

            'target_type'  => ['required', Rule::in(['user', 'users', 'all', 'topic'])],
            'user_id'      => ['required_if:target_type,user', 'nullable', 'exists:users,id'],
            'user_ids'     => ['required_if:target_type,users', 'nullable', 'array', 'min:1'],
            'user_ids.*'   => ['exists:users,id'],
            'topic'        => ['required_if:target_type,topic', 'nullable', 'string', 'max:100'],

            'send_option'  => ['required', Rule::in(['now', 'schedule'])],
            'scheduled_at' => ['required_if:send_option,schedule', 'nullable', 'date', 'after:now'],
            'timezone'     => ['required_if:send_option,schedule', 'nullable', 'timezone'],
        ];
    }

    public function resolvedTargetValue(): mixed
    {
        return match ($this->input('target_type')) {
            'user'  => $this->input('user_id'),
            'users' => $this->input('user_ids'),
            'topic' => $this->input('topic'),
            'all'   => null,
        };
    }
}
