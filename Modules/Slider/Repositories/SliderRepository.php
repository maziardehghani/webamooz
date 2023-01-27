<?php

namespace Modules\Slider\Repositories;

use Modules\Slider\Models\Slider;

class SliderRepository
{
    public function Banners()
    {
        return Slider::query()
            ->where('type' , Slider::DYNAMIC_BANNER)
            ->where('status' , 1)
            ->orderBy('priority')
            ->get();
    }
    public function Adds()
    {
        return Slider::query()
            ->where('type' , Slider::STATIC_BANNER)
            ->where('status' , 1)
            ->orderBy('priority')
            ->take(3)
            ->get();
    }
    public function getSliders()
    {
        return Slider::query()->latest()->paginate();
    }
    public function find($id)
    {
        return Slider::query()->find($id);
    }
    public function store($value)
    {
        return Slider::create([
            'title' => $value->title,
            'link' => $value->link,
            'priority' => $value->priority,
            'status' => $value->status,
            'type' => $value->type,
            'banner_id' => $value->banner_id
        ]);
    }

    public function changeStatus($status , $id)
    {
        $slider = $this->find($id);
        return $slider->update(['status' => $status]);
    }

    public function update($value , $slider)
    {
        return $slider->update([
            'title' => $value->title,
            'link' => $value->link,
            'priority' => $value->priority,
            'status' => $value->status,
            'type' => $value->type,
            'banner_id' => $value->banner_id
        ]);
    }
}
