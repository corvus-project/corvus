<?php

namespace Corvus\Core\Repositories\Pricing;
        
use Corvus\Core\Models\Pricing;
use Corvus\Core\Repositories\Pricing\PricingRepositoryInterface;
use Corvus\Core\Repositories\BaseRepository;
use Illuminate\Support\Collection;

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