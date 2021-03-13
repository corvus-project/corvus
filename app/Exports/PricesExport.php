<?php

namespace App\Exports;

use Corvus\Core\Models\Pricing;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class PricesExport implements FromQuery
{
    use Exportable;

    public function __construct($date_selection, int $pricing_group_id)
    {
        $this->date_selection = $date_selection;
        $this->pricing_group_id = $pricing_group_id;
    }

    public function query()
    {
        $date_selection = $this->date_selection;
        $pricing_group_id = $this->pricing_group_id;

        $q = Pricing::query()
            ->join('products', 'products.id', '=', 'pricings.product_id')
            ->join('pricing_groups', 'pricing_groups.id', '=', 'pricings.pricing_group_id')
            ->select(
                'products.sku as product_sku',
                'products.name as product_name',
                'pricings.price as price',
                'pricings.from_date as DATE_FORMAT(from_date, "Y-m-d")',
                'pricings.to_date as (to_date, "Y-m-d")',
                'pricing_groups.name as pricing_group_name'
                )
            ->where(function ($query) use ($date_selection) {
                if ($date_selection === 'current_date'){
                    $query->whereRaw('CURDATE() between from_date and to_date');
                }
            })
            ->where(function ($query) use ($pricing_group_id) {
                if ($pricing_group_id > 0){
                    $query->where('pricing_group_id', $pricing_group_id);
                }
            });

        return $q;
    }
}
