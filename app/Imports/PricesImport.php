<?php

namespace App\Imports;

use App\Models\Pricing;
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

class PricesImport implements ToModel, WithCustomCsvSettings, SkipsOnError, ShouldQueue, WithChunkReading
{
    use Importable, SkipsFailures, SkipsErrors;

    public function __construct($to_date, int $pricing_group_id)
    {
        $this->to_date = $to_date;
        $this->pricing_group_id = $pricing_group_id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            $p = Product::where('sku', $row[0])->first();
            $id = $p->id;            
            $last = Pricing::where('product_id', $id)
                                ->where('pricing_group_id', $this->pricing_group_id)
                                ->orderBy('to_date', 'DESC')
                                ->first();
            if ($last){
                Pricing::where('id', $last->id)
                                ->update(['amount' => $row[1], 'to_date' => $this->to_date]);
                                return;
            }else{
                return Pricing::create([
                            'product_id' => $id, 
                            'pricing_group_id' => $this->pricing_group_id, 
                            'amount' => $row[1], 
                            'from_date' => Carbon::now(), 
                            'to_date' => $this->to_date
                            ]);
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
