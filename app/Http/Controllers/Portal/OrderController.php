<?php

namespace App\Http\Controllers\Portal;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB; 
use App\Jobs\ProcessOrder;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('portal.orders.index');
    }

    public function view(Order $order)
    {
        $status = OrderStatus::all();
        $allowed_status = $status->whereNotIn('slug', ['CANCELED', 'APPROVED'])->pluck('id')->toArray();

        $orderlines = $order->order_lines()->orderBy('created_at', 'DESC')->get();

        return view('portal.orders.view', compact('order', 'orderlines','allowed_status'));
    } 

    public function data()
    {
        $user = Auth::user();
        $orders = DB::table('order_headers')
            ->join('users', 'order_headers.user_id', '=', 'users.id')
            ->join('order_status', 'order_headers.status', '=', 'order_status.id')
            ->where('order_headers.user_id', $user->id)
            //select columns for new virtual table. ID columns must be renamed, because they have the same title
            ->select(['users.name as user_name', 'order_headers.id', 'order_headers.order_date', 'order_status.name as status_name']);

        return datatables()->of($orders)->toJson();
    }

    public function upload()
    {
        return view('portal.orders.upload');
    }


    public function save_file(OrderFileRequest $request)
    {
        if ($request->hasfile('order_file')) {
            $folder = null;
            $file = $request->file('order_file');
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
                (new ProductsImport)->import($filename, null, \Maatwebsite\Excel\Excel::CSV);
            }
        }
 
        return redirect(route('admin.tools.import.index'))->withFlashSuccess(trans('labels.import.sucess'));
    }


}
