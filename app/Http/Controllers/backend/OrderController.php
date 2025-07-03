<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Traits\SystemTrait;
use App\Http\Requests\OrderRequest;
use App\Models\PermissionRole;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    use SystemTrait;

    protected $orderService, $productService;

    public function __construct(OrderService $orderService, ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $PermissionOrder = PermissionRole::getPermission('Order',Auth::user()->role_id);
        if(empty($PermissionOrder))
        {
            abort(404);
        }
        $data['PermissionAdd']=PermissionRole::getPermission('Add Order', Auth::user()->role_id);
        $data['PermissionEdit']=PermissionRole::getPermission('Edit Order', Auth::user()->role_id);
        $data['PermissionDelete']=PermissionRole::getPermission('Delete Order', Auth::user()->role_id);

        $data['orders'] = $this->orderService->all();
        return view('admin.order.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $PermissionOrder = PermissionRole::getPermission('Add Order',Auth::user()->role_id);
        if(empty($PermissionOrder))
        {
            abort(404);
        }

        $data['products'] = $this->productService->all(); // Fetch all products via ProductService
        return view('admin.order.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $PermissionOrder = PermissionRole::getPermission('Add Order',Auth::user()->role_id);
        if(empty($PermissionOrder))
        {
            abort(404);
        }
        $validatedData = $request->validated();
        $this->orderService->create($validatedData); // Use OrderService to handle creation logic

        return redirect()->route('backend.order.index')->with('success', 'Order created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $PermissionOrder = PermissionRole::getPermission('Edit Order',Auth::user()->role_id);
        if(empty($PermissionOrder))
        {
            abort(404);
        }
        $data['order'] = $order;
        $data['products'] = $this->productService->all(); // Fetch all products for the dropdown
        return view('admin.order.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $PermissionOrder = PermissionRole::getPermission('Edit Order',Auth::user()->role_id);
        if(empty($PermissionOrder))
        {
            abort(404);
        }
        $validatedData = $request->validated();

        $updated = $this->orderService->update($order->id, $validatedData); // Update using OrderService

        if ($updated) {
            return redirect()->route('backend.order.index')->with('success', 'Order updated successfully');
        }

        return redirect()->route('backend.order.index')->with('error', 'Failed to update the order');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $PermissionOrder = PermissionRole::getPermission('Delete Order',Auth::user()->role_id);
        if(empty($PermissionOrder))
        {
            abort(404);
        }
        $deleted = $this->orderService->delete($order->id); // Delete using OrderService

        if ($deleted) {
            return redirect()->route('backend.order.index')->with('success', 'Order deleted successfully');
        }

        return redirect()->route('backend.order.index')->with('error', 'Failed to delete the order');
    }
}
