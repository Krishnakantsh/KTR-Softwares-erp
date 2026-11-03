<?php

// namespace App\Http\Requests\Auth;

// use Illuminate\Auth\Events\Lockout;
// use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\RateLimiter;
// use Illuminate\Support\Str;
// use Illuminate\Validation\ValidationException;

// class LoginRequest extends FormRequest
// {

//     public function authorize(): bool
//     {
//         return true;
//     }


//     public function rules(): array
//     {
//         return [
//             'email' => ['required', 'string', 'email'],
//             'password' => ['required', 'string'],
//         ];
//     }


//     public function authenticate(): void
//     {
//         $this->ensureIsNotRateLimited();

//         if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
//             RateLimiter::hit($this->throttleKey());

//             throw ValidationException::withMessages([
//                 'email' => trans('auth.failed'),
//             ]);
//         }

//         RateLimiter::clear($this->throttleKey());
//     }

//     public function ensureIsNotRateLimited(): void
//     {
//         if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
//             return;
//         }

//         event(new Lockout($this));

//         $seconds = RateLimiter::availableIn($this->throttleKey());

//         throw ValidationException::withMessages([
//             'email' => trans('auth.throttle', [
//                 'seconds' => $seconds,
//                 'minutes' => ceil($seconds / 60),
//             ]),
//         ]);
//     }


//     public function throttleKey(): string
//     {
//         return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
//     }
// }


namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            'login' => ['required', 'string'],

            'password' => ['required', 'string'],

            'remember' => ['nullable', 'boolean'],

            'type' => ['nullable', 'integer'],

        ];
    }

    /**
     * Check Rate Limiter
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Clear Rate Limiter
     */
    public function clearRateLimiter(): void
    {
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Hit Rate Limiter
     */
    public function hitRateLimiter(): void
    {
        RateLimiter::hit($this->throttleKey());
    }

    /**
     * Throttle Key
     */
    public function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower($this->string('login')) . '|' . $this->ip()
        );
    }
}
