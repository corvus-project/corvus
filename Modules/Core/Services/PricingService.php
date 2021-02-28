<?php

namespace Modules\Core\Services;

use Modules\Core\Repositories\Pricing\PricingRepositoryInterface;

class PricingService
{
    private $pricingRepository;
  
    public function __construct(PricingRepositoryInterface $pricingRepository)
    {
        $this->pricingRepository = $pricingRepository;
    }

    public function getPricingbyProductId()
    {
        return         $this->pricingRepository->all();
    }
      
}