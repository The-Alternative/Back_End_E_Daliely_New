<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Admin\RoleService;
use App\Service\Admin\UserService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    use GeneralTrait;
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->middleware(['role:superadministrator']);
        $this->middleware(['permission:user-read'])->only('getAll','GetById');
        $this->middleware(['permission:user-create'])->only('create');
        $this->middleware(['permission:user-update'])->only('update');
        $this->middleware(['permission:user-delete'])->only(['trash','restoreTrashed','getTrashed']);
        $this->userService=$userService;
    }
    public function getAll()
    {
        $response= $this->userService->getAll();
        return $response;
    }
    public function getById($id)
    {
        $response= $this->userService->getById($id);
        return $response;
    }
    public function getTrashed()
    {
        $response= $this->userService->getTrashed();
        return $response;
    }
    public function create(Request $request)
    {
        $response= $this->userService->create($request);
        return $response;
    }
    public function update(Request $request,$id)
    {
        $response= $this->userService->update($request,$id);
        return $response;
    }
    public function search($title)
    {
        $response= $this->userService->search($title);
        return $response;
    }
    public function trash($id)
    {
        $response= $this->userService->trash($id);
        return $response;
    }
    public function restoreTrashed($id)
    {
        $response= $this->userService->restoreTrashed($id);
        return $response;
    }
    public function delete($id)
    {
        $response= $this->userService->delete($id);
        return $response;
    }
}
