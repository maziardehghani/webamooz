<?php

namespace Modules\Discount\Repository;

use Carbon\Carbon;
use Modules\Course\Repository\CourseRepository;
use Modules\Discount\Model\Discount;

class DiscountRepository
{

    public function special_store($request)
    {
        $course = (new CourseRepository())->findById($request->course);
        $course->discounts()->create([
            'user_id' => auth()->id(),
            'code' => $request->code,
            'percent' => $request->percent,
            'usage_limitation' => $request->usage_limitation,
            'expire_at' => Carbon::now()->addHours($request->expire_at),
            'link' => $request->link,
            'type' => $request->type,
            'description' => $request->description,
            'uses' => 0
        ]);
    }
    public function store_all($request)
    {
        $courses = (new CourseRepository())->paginate();
        foreach ($courses as $course)
        {
            $course->discounts()->create([
                'user_id' => auth()->id(),
                'code' => $request->code,
                'percent' => $request->percent,
                'usage_limitation' => $request->usage_limitation,
                'expire_at' => Carbon::now()->addHours($request->expire_at),
                'link' => $request->link,
                'type' => $request->type,
                'description' => $request->description,
                'uses' => 0
            ]);
        }

    }

    public function paginate()
    {
        return Discount::query()->latest()->paginate();
    }

    public function findByID($discount_id)
    {
        return Discount::query()->findOrFail($discount_id);
    }
}
