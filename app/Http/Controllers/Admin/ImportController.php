<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Requests\CsvImportRequest;
use Storage;
use Illuminate\Http\UploadedFile;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Csv;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin.tools.import');
    }
 
    public function csv_file(CsvImportRequest  $request)
    {
        if ($request->hasfile('csv_file')) {
            $folder = null;
            $file = $request->file('csv_file');
            $filename = time() .'.' . $file->getClientOriginalExtension();
            $filePath = $folder . $filename;
            $rst = $this->upload($file, $folder, 'local', $filename);
            if($rst){
                (new ProductsImport)->import($filename, null, \Maatwebsite\Excel\Excel::CSV);
            }
        }
 
        return redirect(route('admin.tools.import.index'))->withFlashSuccess(trans('import::labels.file.uploaded'));
    }

    public function upload(UploadedFile $uploadedFile, $folder = null, $disk = 'local', $name)
    {
        $uploadedFile->storeAs($folder, $name, $disk);
        return true;
    }

}
