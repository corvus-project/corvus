<?php

namespace App\Imports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors; 
use Carbon\Carbon as Carbon;

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
        return Stock::updateOrCreate(
            ['product_id' => $row[0], 'warehouse_id' => $row[1], 'stock_type_id' => $row[2]],
            ['quantity' => $row[5]]
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
