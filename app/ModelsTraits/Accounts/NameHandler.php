<?php

namespace App\ModelsTraits\Accounts;

/**
 * @author Abdullah Essam <abdoessam.2010@gmail.com>
 */
trait NameHandler {
    
    /**
     * fix for name columns at accounts tables,
     * this takes the column and explode it to first name and last name by using space between words as separator
     *
     * @return array
     */
    public function getNameAsFirstLastAttribute(): array
    {
        $fullName = explode(' ', $this->name, 2);
        return [
            'f_name' => trim($fullName[0]),
            'l_name' => isset($fullName[1]) ? trim($fullName[1]) : '',
        ];
    }

}