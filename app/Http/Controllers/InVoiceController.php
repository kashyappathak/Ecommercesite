<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;
use PHPUnit\TextUI\Configuration\Php;

class InvoiceController extends Controller
{
    public function index()
    {
        $superadmin = User::where('role_as', 1)->first();
        $orderItems = OrderItem::where('user_id', Auth::user()->id)
        ->orderBy('order_id', 'desc')
        ->get();
    
    // Group the order items by order_id
    $groupedOrderItems = $orderItems->groupBy('order_id');
    $setting = Setting::find(1);
   
   
    $pdf = Pdf::loadView('Frontend.invoice',compact('orderItems','superadmin','groupedOrderItems'));   
    return $pdf->download($setting->website_name . '.pdf');

    }
}