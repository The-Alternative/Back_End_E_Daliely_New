<?php


namespace App\Service\Order;


use App\Http\Requests\Order\OrderRequest;
use App\Models\Order\Order;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;

class OrderService
{
    private $OrderModel;
    use GeneralTrait;


    public function __construct(Order $order)
    {
        $this->OrderModel=$order;
    }
    public function get()
    {
        try
        {
            $order= $this->OrderModel::paginate(5);
            return $this->returnData('order',$order,'done');
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function getById($id)
    {
        try
        {
            $order= $this->OrderModel::find($id);
            if (is_null($order) ){
                return $this->returnSuccessMessage('This order not found','done');}
            else{
                return  $this->returnData('order',$order,'done');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400',$ex->getMessage());
        }
    }
    public function create( OrderRequest $request )
    {
        try {
            $order = new Order();

            $order->customer_id   = $request->customer_id;
            $order->total         = $request->total;
            $order->date          = $request->date;
            $order->is_approved  = $request->is_approved;
            $order->is_active    = $request->is_active;

            $result = $order->save();

            if ($result)
            {
                return $this->returnData('order', $order, 'done');
            }
            else
            {
                return $this->returnError('400', 'saving failed');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function update(OrderRequest $request,$id)
    {
        try {
            $order= $this->OrderModel::find($id);

            $order->customer_id   = $request->customer_id;
            $order->total         = $request->total;
            $order->date          = $request->date;
            $order->is_approved  = $request->is_approved;
            $order->is_active    = $request->is_active;
            $result=$order->save();
            if ($result)
            {
                return $this->returnData('order', $order,'done');
            }
            else
            {
                return $this->returnError('400', 'updating failed');
            }
        }
        catch(\Exception $ex)
        {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function trash( $id)
    {
        try {
            $order = $this->OrderModel::find($id);
            if (is_null($order)) {
                return $this->returnSuccessMessage('This order not found', 'done');
            } else {
                $order->is_active = 0;
                $order->save();
                return $this->returnData('order', $order, 'This order is trashed Now');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function getTrashed()
    {
        try {
            $order= $this->OrderModel::NotActive()->get();
            return $this -> returnData('order',$order,'done');
        }
        catch (\Exception $ex)
        {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function restoreTrashed( $id)
    {
        try {
            $order =$this->OrderModel->find($id);
            if (is_null($order)) {
                return $this->returnSuccessMessage('This order not found', 'done');
            } else {
                $order->is_active = 1;
                $order->save();
                return $this->returnData('order', $order, 'This order is trashed Now');
            }
        }
        catch (\Exception $ex)
        {
            return $this->returnError('400', $ex->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $order = $this->OrderModel->find($id);
            if ($order->is_active == 0) {
                $order = $this->OrderModel->destroy($id);

                return $this->returnData('order', $order, 'This order Is deleted Now');
            }
            else {
                return $this->returnData('order', $order, 'This order can not deleted Now');

            }
        } catch (\Exception $ex) {
            return $this->returnError('400', $ex->getMessage());
        }
    }
}
