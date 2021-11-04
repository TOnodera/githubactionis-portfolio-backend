<?php

namespace App\Http\Controllers;

use App\Domain\Content\Role as DomainRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private DomainRole $domain;
    public function __construct()
    {
        $this->domain = new DomainRole;
    }

    public function index(Request $request)
    {
        return $this->domain->index($request);
    }

    public function create(Request $request)
    {
        return $this->domain->create($request);
    }
}
