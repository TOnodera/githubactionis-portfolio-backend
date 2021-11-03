<?php

namespace App\Domain;

use DomainException;

class Role
{
    private $enableActions;
    
    public function __construct(array $enableActions)
    {
        if (count($this->actions) <= 0) {
            throw new DomainException();
        }
        $this->enableActions = $enableActions;
    }

    public function store()
    {
        if (!in_array('create-roles', $this->enableActions)) {
               
        }
    }
}
