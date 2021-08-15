<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\OfferRequest;
use App\Service\Offer\OfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    protected $OfferService;

    public function __construct(OfferService $OfferService)
    {
        $this->OfferService=$OfferService;
    }
    public function get()
    {
        return $this->OfferService->get();
    }
    public function getById($id)
    {
        return $this->OfferService->getById($id);
    }

    public function create(OfferRequest $request)
    {
      return $this->OfferService->create($request);
    }
    public function update(OfferRequest $request,$id)
    {
       return $this->OfferService->update($request,$id);
    }

    public function Trash($id)
    {
        return $this->OfferService->Trash($id);
    }
    public function NotActive()
    {
        return "00";
//        return $this->OfferService->NotActive();
    }
    public function restoreTrashed($id)
    {
        return $this->OfferService->restoreTrashed($id);
    }
    public function delete($id)
    {
        return $this->OfferService->delete($id);
    }
}

