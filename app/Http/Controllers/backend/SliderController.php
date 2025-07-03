<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Traits\SystemTrait;
use App\Http\Requests\SliderRequest;
use App\Models\PermissionRole;
use App\Services\SliderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class SliderController extends Controller
{
    use SystemTrait;
    protected $sliderService;
    public function __construct(SliderService $sliderService)
    {
        $this->sliderService=$sliderService;

    }
    public function index()
    {
        $PermissionSlider = PermissionRole::getPermission('Slider', Auth::user()->role_id);
        if(empty($PermissionSlider))
        {
            abort(404);
        }
        $data['PermissionAdd']=PermissionRole::getPermission('Add Slider', Auth::user()->role_id);
        $data['PermissionEdit']=PermissionRole::getPermission('Edit Slider', Auth::user()->role_id);
        $data['PermissionDelete']=PermissionRole::getPermission('Delete Slider', Auth::user()->role_id);
    //   $data['sliders']=Slider::get();
    $data['sliders']=$this->sliderService->all();
      return view('admin.slider.index',$data);
    }


    public function create()
    {
        $PermissionSlider = PermissionRole::getPermission('Add Slider',Auth::user()->role_id);
        if(empty($PermissionSlider))
        {
            abort(404);
        }
     return view('admin.slider.form');
    }


    public function store(SliderRequest $request)
    {
        $PermissionSlider = PermissionRole::getPermission('Add Slider',Auth::user()->role_id);
        if(empty($PermissionSlider))
        {
            abort(404);
        }
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->fileUpload($request->file('image'), 'slider');
        }

        Slider::create($validatedData);

        return redirect()->route('backend.slider.index')->with('success', 'Slider created successfully');
    }

    public function edit(Slider $slider)
    {
        $PermissionSlider = PermissionRole::getPermission('Edit Slider',Auth::user()->role_id);
        if(empty($PermissionSlider))
        {
            abort(404);
        }
       return view('admin.slider.form',compact('slider'));
    }


    public function update(SliderRequest $request, Slider $slider)
    {
        $PermissionSlider = PermissionRole::getPermission('Edit Slider',Auth::user()->role_id);
        if(empty($PermissionSlider))
        {
            abort(404);
        }
        $validatedData = $request->validated();

        // Check if a new image file has been uploaded
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($slider->image && File::exists(public_path('storage/' . $slider->image))) {
                File::delete(public_path('storage/' . $slider->image));
            }

            // Upload the new image
            $validatedData['image'] = $this->fileUpload($request->file('image'), 'slider');
        }

        // Update the slider using the service
        $updated = $this->sliderService->update($slider->id, $validatedData);

        if ($updated) {
            return redirect()->route('backend.slider.index')->with('success', 'Slider updated successfully');
        }

        return redirect()->route('backend.slider.index')->with('error', 'Failed to update the slider');
    }



    public function destroy(Slider $slider)
    {
        $PermissionSlider = PermissionRole::getPermission('Delete Slider',Auth::user()->role_id);
        if(empty($PermissionSlider))
        {
            abort(404);
        }
        $deleted = $this->sliderService->delete($slider->id);

        if ($deleted) {
            return redirect()->route('backend.slider.index')->with('success', 'Slider deleted successfully');
        }

        return redirect()->route('backend.slider.index')->with('error', 'Failed to delete the slider');
    }


}
