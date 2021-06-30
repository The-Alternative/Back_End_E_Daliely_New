<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use App\Service\Order\OrderService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    use GeneralTrait;
    private $OrderService;

    public function __construct(OrderService $OrderService )
    {
        $this->OrderService=$OrderService;
    }
    public function get()
    {
        return $this->OrderService->get();
    }

    public function  getById($id)
    {
        return $this->OrderService->getById($id);
    }

    public function create(OrderRequest $request)
    {
        return   $this->OrderService->create($request);
    }

    public function update(OrderRequest $request,$id)
    {
        return $this->OrderService->update($request,$id);
    }

    public function trash($id)
    {
        return    $this->OrderService->trash($id);
    }
    public function getTrashed()
    {
        return  $this->OrderService->getTrashed();
    }

    public function restoreTrashed($id)
    {
        return   $this->OrderService->restoreTrashed($id);
    }

    public function delete($id)
    {
        return $this->OrderService->delete($id);
    }

}
