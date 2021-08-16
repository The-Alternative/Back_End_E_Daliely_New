<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\OfferUserRequest;
use App\Service\Offer\OfferUserService;
use Illuminate\Http\Request;

class OfferUserController extends Controller
{
    protected $OfferUserService;

    public function __construct(OfferUserService $OfferUserService)
    {
        $this->OfferUserService=$OfferUserService;
    }
    public function get()
    {
        return $this->OfferUserService->get();
    }
    public function getById($id)
    {
        return $this->OfferUserService->getById($id);
    }

    public function create(OfferUserRequest $request)
    {
        return $this->OfferUserService->create($request);
    }
    public function update(OfferUserRequest $request,$id)
    {
        return $this->OfferUserService->update($request,$id);
    }

    public function Trash($id)
    {
        return $this->OfferUserService->Trash($id);
    }
    public function getTrashed()
    {
        return $this->OfferUserService->getTrashed();
    }
    public function restoreTrashed($id)
    {
        return $this->OfferUserService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->OfferUserService->delete($id);
    }
}
