<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected $forbidden;
    public function __construct($forbidden)
    {
        $this->forbidden = strtolower($forbidden);
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        // check if name = laravel
        if (strtolower($value) == $this->forbidden) {
            $fail('name cannot be laravel');
            }

    }

}
