<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors; 
use Carbon\Carbon as Carbon;

class ProductsImport implements ToModel, WithCustomCsvSettings, SkipsOnError, ShouldQueue, WithChunkReading
{
    use Importable, SkipsFailures, SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try{
            return Product::updateOrCreate(
                ['sku' => $row[0]],
                ['name' => $row[1], 'description' =>  (empty($row[2]) ? null : $row[2])]
            );
        }catch(Exception $x){
            new Exception('Can\'t create or update this row:'. $row_data);
        }
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