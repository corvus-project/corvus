<?php

namespace Core\Services;

use Core\Repositories\Pricing\PricingRepositoryInterface;

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