<?php

namespace Modules\Core\Repositories\Pricing;

use App\Models\Pricing;
use Modules\Core\Repositories\Pricing\PricingRepositoryInterface;
use Illuminate\Support\Collection;
use Modules\Core\Repositories\BaseRepository;

class PricingRepository extends BaseRepository implements PricingRepositoryInterface
{

   /**
    * PricingRepository constructor.
    *
    * @param Pricing $model
    */
   public function __construct(Pricing $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }
}