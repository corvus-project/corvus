<?php
namespace Corvus\Core\Repositories\Pricing;
          
use Corvus\Core\Models\Pricing;
use Illuminate\Support\Collection;

interface PricingRepositoryInterface
{
   public function all(): Collection;
}