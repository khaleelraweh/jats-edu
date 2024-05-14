<?php

// app/Services/CustomValidationRules.php

namespace App\Services;

class CustomValidationRules
{
    public static function minWords($attribute, $value, $parameters, $validator)
    {
        $minWords = $parameters[0] ?? 0;
        $validator->setCustomMessages([
            'min_words' => 'The :attribute must contain at least ' . $minWords . ' words.',
        ]);
        return str_word_count($value) >= $minWords;
    }
}
