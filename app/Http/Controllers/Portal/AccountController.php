<?php

namespace App\Http\Controllers\Portal;

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
use App\Http\Requests\OrderUploadRequest;
use Storage;
use Illuminate\Http\UploadedFile;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('portal.account.index', compact('user'));
    }
}
