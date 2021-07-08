<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Admin\RoleService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    use GeneralTrait;
    private $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->roleService=$roleService;
        $this->middleware(['role:superadministrator']);
        $this->middleware(['permission:role-read'])->only('getAll','GetById');
        $this->middleware(['permission:role-create'])->only('create');
        $this->middleware(['permission:role-update'])->only('update');
        $this->middleware(['permission:role-delete'])->only(['trash','restoreTrashed','getTrashed']);
    }
    public function getAll()
    {
        $response= $this->roleService->getAll();
        return $response;
    }
    public function getById($id)
    {
        $response= $this->roleService->getById($id);
        return $response;
    }
    public function getTrashed()
    {
        $response= $this->roleService->getTrashed();
        return $response;
    }
    public function create(Request $request)
    {
        $response= $this->roleService->create($request);
        return $response;
    }
    public function update(Request $request,$id)
    {
        $response= $this->roleService->update($request,$id);
        return $response;
    }
    public function search($title)
    {
        $response= $this->roleService->search($title);
        return $response;
    }
    public function trash($id)
    {
        $response= $this->roleService->trash($id);
        return $response;
    }
    public function restoreTrashed($id)
    {
        $response= $this->roleService->restoreTrashed($id);
        return $response;
    }
    public function delete($id)
    {
        $response= $this->roleService->delete($id);
        return $response;
    }
}
