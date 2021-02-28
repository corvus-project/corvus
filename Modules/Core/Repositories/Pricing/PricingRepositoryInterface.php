<?php
namespace Modules\Core\Repositories\Pricing;

use App\Models\Pricing;
use Illuminate\Support\Collection;

interface PricingRepositoryInterface
{
   public function all(): Collection;
}