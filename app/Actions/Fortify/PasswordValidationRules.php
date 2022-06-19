<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        return ['required', 'string', $this->setPasswordObj(), 'confirmed'];
    }

    private function setPasswordObj()
    {
        $pass = new Password();

        $pass->length(7);
        $pass->requireNumeric();
        $pass->requireUppercase();

        return $pass;
    }
}
