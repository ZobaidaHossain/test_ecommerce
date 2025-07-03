<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\SystemTrait;
use App\Http\Requests\ProductRequest;
use App\Models\PermissionRole;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    use SystemTrait;
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;

    }
    public function index()
    {
        $PermissionProduct = PermissionRole::getPermission('Product',Auth::user()->role_id);
        if(empty($PermissionProduct))
        {
            abort(404);
        }
        $data['PermissionAdd']=PermissionRole::getPermission('Add Product', Auth::user()->role_id);
        $data['PermissionEdit']=PermissionRole::getPermission('Edit Product', Auth::user()->role_id);
        $data['PermissionDelete']=PermissionRole::getPermission('Delete Product', Auth::user()->role_id);

        $data['products']=$this->productService->all();
        return view('admin.product.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $PermissionProduct = PermissionRole::getPermission('Add Product',Auth::user()->role_id);
        if(empty($PermissionProduct))
        {
            abort(404);
        }

        return view('admin.product.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $PermissionProduct = PermissionRole::getPermission('Add Product',Auth::user()->role_id);
        if(empty($PermissionProduct))
        {
            abort(404);
        }

        $validatedData= $request->validated();
        if($request->hasFile('image')){
            $validatedData['image']=$this->fileUpload($request->file('image'),'product');
        }
        Product::create($validatedData);
        return redirect()->route('backend.product.index')->with('success','Product created successfully');
    }
    public function edit(Product $product)
    {
        $PermissionProduct = PermissionRole::getPermission('Edit Product',Auth::user()->role_id);
        if(empty($PermissionProduct))
        {
            abort(404);
        }
        return view('admin.product.form',compact('product'));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $PermissionProduct = PermissionRole::getPermission('Edit Product',Auth::user()->role_id);
        if(empty($PermissionProduct))
        {
            abort(404);
        }

        $validatedData = $request->validated();

        // Check if a new image file has been uploaded
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image && File::exists(public_path('storage/' . $product->image))) {
                File::delete(public_path('storage/' . $product->image));
            }

            // Upload the new image
            $validatedData['image'] = $this->fileUpload($request->file('image'), 'product');
        }

        // Update the slider using the service
        $updated = $this->productService->update($product->id, $validatedData);

        if ($updated) {
            return redirect()->route('backend.product.index')->with('success', 'product updated successfully');
        }

        return redirect()->route('backend.product.index')->with('error', 'Failed to update the slider');
    }

    public function destroy(Product $product)
    {
        $PermissionProduct = PermissionRole::getPermission('Delete Product',Auth::user()->role_id);
        if(empty($PermissionProduct))
        {
            abort(404);
        }

        $deleted = $this->productService->delete($product->id);

        if ($deleted) {
            return redirect()->route('backend.product.index')->with('success', 'product deleted successfully');
        }

        return redirect()->route('backend.product.index')->with('error', 'Failed to delete the product');
    }
}
