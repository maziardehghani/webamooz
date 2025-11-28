<?php

namespace Modules\Slider\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Media\Services\MediaFileService;
use Modules\Slider\Http\Requests\SliderRequest;
use Modules\Slider\Repositories\SliderRepository;

class SliderController extends Controller
{
    private $sliderRepository;
    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }
    public function index()
    {
        $this->authorize('manage');
        $sliders = $this->sliderRepository->getSliders();
        return view('slider::index' , compact('sliders'));
    }
    public function create()
    {
        $this->authorize('manage');

        return view('slider::layouts.create');
    }
    public function store(SliderRequest $request)
    {
        $this->authorize('store');
        $request->request->add(['banner_id' => MediaFileService::uploadPublic($request->file('banner'))->id]);
        $this->sliderRepository->store($request);
        return redirect()->to(route('dashboard.sliders'));
    }
    public function changeStatus($status ,$id)
    {
        $this->authorize('store');
        $this->sliderRepository->changeStatus($status , $id);
        return redirect()->back();
    }
    public function edit($id)
    {
        $this->authorize('update');

        $slider = $this->sliderRepository->find($id);

        return view('slider::layouts.edit' , compact('slider'));
    }
    public function update(SliderRequest $request , $id)
    {
        $this->authorize('update');

        $slider = $this->sliderRepository->find($id);
        if ($request->hasFile('banner'))
        {
            $request->request->add(['banner_id' => MediaFileService::uploadPublic($request->file('banner'))->id]);

            if ($slider->banner)
                $slider->banner->delete();
        }else
        {
            $request->request->add(['banner_id' => $slider->banner_id]);
        }
        $this->sliderRepository->update($request , $slider);
        return redirect()->route('dashboard.sliders');

    }
    public function delete($id)
    {
        $this->authorize('delete');

        $slider = $this->sliderRepository->find($id);
        if ($slider->banner)
        {
            $slider->banner->delete();
        }
        $slider->delete();
        return redirect()->to(route('dashboard.sliders'));
    }
}
