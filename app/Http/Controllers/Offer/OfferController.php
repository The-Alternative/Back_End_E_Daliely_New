<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\OfferRequest;
use App\Service\Offer\OfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    private $OfferService;

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

    public function restoreTrashed($id)
    {
        return $this->OfferService->restoreTrashed($id);
    }
    public function delete($id)
    {
      
        return $this->OfferService->delete($id);
    }

    public function getStoreByOfferId($Offer_id)
    {
        return $this->OfferService->getStoreByOfferId($Offer_id);
    }
    public  function getOfferByStoreId($Store_id)
    {
        return $this->OfferService->getOfferByStoreId($Store_id);
    }
    /////////////////////////////////////////////////////////////////////////
    public function getAdvertisement()
    {
        return $this->OfferService->getAdvertisement();
    }
    public function getTrashed()
    {
        return $this->OfferService->getTrashed();
    }
    public function OfferApproved($offer_id)
    {
        return $this->OfferService->OfferApproved($offer_id);
    }

    
    
}

