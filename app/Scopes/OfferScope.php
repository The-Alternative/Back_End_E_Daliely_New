<?php


namespace App\Scopes;

use App\Models\Doctors\DoctorTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class OfferScope implements Scope
{

    /**
     * @inheritDoc
     */
    public function apply(Builder $builder, Model $model)
    {
      $builder->join('offer_translations','offers.id','=','offer_translations.offer_id')
              ->where('offer_translations.locale','=',config::get('app.locale'))

              ->select(['offers.id','offers.is_active','offers.is_approved','offers.is_offer',
                        'offers.price','offers.selling_price','offers.started_at',
                        'offers.ended_at','offers.quantity',
                        'offers.store_product_id','offers.store_id','offers.position',
                        'offer_translations.name','offer_translations.short_description',
                        'offer_translations.long_description','offer_translations.locale']);
                        

    }
  }
