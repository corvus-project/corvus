<?php

namespace Core\Repositories\Pricing;

use App\Models\Pricing;
use Core\Repositories\Pricing\PricingRepositoryInterface;
use Illuminate\Support\Collection;
use Core\Repositories\BaseRepository;

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