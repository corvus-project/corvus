<?php

namespace App\Imports;

use Corvus\Core\Models\Stock;
use Corvus\Core\Models\Warehouse;
use Corvus\Core\Models\StockGroup;
use Corvus\Core\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Carbon\Carbon as Carbon;
use Exception;

class StocksImport implements ToModel, WithCustomCsvSettings, SkipsOnError, ShouldQueue, WithChunkReading
{
    use Importable, SkipsFailures, SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $warehouse = Warehouse::where('name', $row[2])->orWhere('slug', $row[2])->first();
        $stock_group = StockGroup::where('name', $row[3])->orWhere('slug', $row[3])->first();
        $product = Product::where('sku', $row[0])->first();
        if ($warehouse && $stock_group && $product){
            $row_data = implode(" ", $row);
            new Exception('Can\'t create or update this row:'. $row_data);
        }
        return Stock::updateOrCreate(
            ['product_id' => $product->id, 'warehouse_id' => $warehouse->id, 'stock_group_id' => $stock_group->id],
            ['quantity' => intval($row[1])]
        );
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1'
        ];
    }
}
