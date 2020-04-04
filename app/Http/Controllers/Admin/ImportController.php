<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Requests\CsvImportRequest;
use Storage;
use Illuminate\Http\UploadedFile;
use App\Imports\ProductsImport;
use App\Imports\StocksImport;
use App\Imports\PricesImport;
use App\Models\PricingGroup;
use App\Models\Warehouse;
use App\Models\StockGroup;
use App\Models\User;

use Maatwebsite\Excel\Facades\Csv;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        $pricing_groups->put(0, 'Select');
        $pricing_groups = $pricing_groups->reverse();

        return view('admin.tools.import', compact('pricing_groups'));
    }
 
    public function csv_file(CsvImportRequest $request)
    {
        if ($request->hasfile('csv_file')) {
            $folder = null;
            $file = $request->file('csv_file');
            $filename = time() .'.' . $file->getClientOriginalExtension();
            $filePath = $folder . $filename;
            $rst = $this->upload($file, $folder, 'local', $filename);
            if($rst){
                
                switch($request->model){
                    case 'product':
                        (new ProductsImport)->import($filename, null, \Maatwebsite\Excel\Excel::CSV);
                    break;

                    case 'pricelist':
                        $pricing_group_id = $request->pricing_group_id;
                        $to_date = $request->to_date;

                        (new PricesImport($to_date, $pricing_group_id))->import($filename, null, \Maatwebsite\Excel\Excel::CSV);
                    break;

                    case 'stocklist':
                        (new StocksImport)->import($filename, null, \Maatwebsite\Excel\Excel::CSV);
                    break;
                }
                 
            }
        }
 
        return redirect(route('admin.tools.import.index'))->withFlashSuccess(trans('labels.import.sucess'));
    }

    public function upload(UploadedFile $uploadedFile, $folder = null, $disk = 'local', $name)
    {
        $uploadedFile->storeAs($folder, $name, $disk);
        return true;
    }

}
