<?php

namespace Corvus\Portal\Controllers;

use Corvus\Core\Models\Order;
use Corvus\Core\Models\OrderStatus;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use App\Jobs\ProcessOrder;
use Auth;
use App\Imports\VendorOrderImport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Corvus\Core\Requests\OrderUploadRequest;
use Storage;
use Illuminate\Http\UploadedFile;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $status = OrderStatus::all();

        $status_json = null;
        foreach($status as $s){
            $status_json .= '{ value: "'. $s->id .'", label: "'. $s->name . '"},';
        }

        return view('portal.orders.index', compact('status_json'));
    }

    public function view(Order $order)
    {
        $status = OrderStatus::all();
        $allowed_status = $status->whereNotIn('slug', ['CANCELED', 'APPROVED'])->pluck('id')->toArray();

        $orderlines = $order->order_lines()->orderBy('created_at', 'DESC')->get();

        return view('portal.orders.view', compact('order', 'orderlines','allowed_status'));
    }

    public function cancel(Order $order)
    {
        $_status = OrderStatus::where('slug', 'CANCELED')->first();
        $order->status = $_status->id;
        $order->save();
        return redirect(route('portal.orders.index'))->withFlashSuccess('Order cancelled');
    }

    public function data()
    {
        $user = Auth::user();
        $orders = DB::table('order_headers')

            ->join('order_status', 'order_headers.status', '=', 'order_status.id')
            ->where('order_headers.user_id', $user->id)
            //select columns for new virtual table. ID columns must be renamed, because they have the same title
            ->select(['order_headers.ref_id as ref_id', 'order_headers.id', 'order_headers.order_date', 'order_status.name as status_name']);

        return datatables()->of($orders)->toJson();
    }

    public function upload()
    {
        return view('portal.orders.upload');
    }


    public function save_file(OrderUploadRequest $request)
    {
        $user = Auth::user();
        if ($request->hasfile('order_file')) {
            $folder = null;
            $file = $request->file('order_file');
            $filename = time() .'.' . $file->getClientOriginalExtension();
            $filePath = $folder . $filename;
            $rst = $this->uploadfile($file, $folder, 'local', $filename);
            if($rst){
                $order = Order::create(['user_id' => $user->id, 'order_date' => Carbon::now(), 'status' => 1, 'ref_id' => $request->ref_id]);
                $order_id = $order->id;
                $_status = OrderStatus::where('slug', 'NEW_ORDER')->first();
                (new VendorOrderImport($order_id, $_status->id))->import($filename, null, \Maatwebsite\Excel\Excel::CSV);
                ProcessOrder::dispatch($order);
                return redirect(route('portal.orders.view', $order_id))->withFlashSuccess(trans('labels.import.sucess'));
            }
        }
        return redirect(route('portal.orders.upload'))->withFlashDanger('Can\'t uploaded your order');
    }

    public function uploadfile(UploadedFile $uploadedFile, $folder = null, $disk = 'local', $name)
    {
        $uploadedFile->storeAs($folder, $name, $disk);
        return true;
    }

}
