<?php

namespace App\Imports;

use App\Models\OrderLine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors; 
use Carbon\Carbon as Carbon;
use DB;

class VendorOrderImport implements ToModel, WithCustomCsvSettings, SkipsOnError, ShouldQueue, WithChunkReading
{
    use Importable, SkipsFailures, SkipsErrors;

    public function __construct(int $order_id)
    {
        $this->order_id = $order_id;
    }


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return OrderLine::create([
            'product_sku' => $row[0],
            'quantity' => $row[1],
            'order_header_id' => $this->order_id,
            'status' => 1
            ]);

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