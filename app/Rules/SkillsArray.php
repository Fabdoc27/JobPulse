<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SkillsArray implements Rule {
    public function passes( $attribute, $value ) {
        return is_array( $value );
    }

    public function message() {
        return 'The skills field is invalid.';
    }
}