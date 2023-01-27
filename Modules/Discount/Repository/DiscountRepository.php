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

    public function getDiscount($discountable_id)
    {
        return Discount::query()
            ->where('discountable_id' , $discountable_id)
            ->where('expire_at' , '>' , now());
    }
    public function discountUses($discountable_id)
    {
        $discount = $this->getDiscount($discountable_id)
            ->orderByDesc('percent')
            ->first();

        return $discount->uses;
    }
    public function getGlobalDiscount($discountable_id)
    {
        return $this->getDiscount($discountable_id)
            ->whereNull('code')
            ->where('type', Discount::TYPE_ALL)
            ->orderByDesc('percent')
            ->first();
    }
    public function getSpecialDiscount($discountable_id , $code)
    {
        $discountUses =  $this->discountUses($discountable_id);
        return $this->getDiscount($discountable_id)
            ->where('code' , $code)
            ->where('usage_limitation' , '>' ,$discountUses)
            ->orderByDesc('percent')
            ->first();
    }
}
