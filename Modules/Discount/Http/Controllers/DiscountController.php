<?php

namespace Modules\Discount\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Course\Repository\CourseRepository;
use Modules\Discount\Http\Requests\DiscountRequest;
use Modules\Discount\Model\Discount;
use Modules\Discount\Repository\DiscountRepository;

class DiscountController extends Controller
{
    public $discountRepository ;
    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    public function index()
    {
        $this->authorize('manage' , Discount::class);
        $courses = (new CourseRepository())->paginate();
        $discounts = $this->discountRepository->paginate();
        return view('discount::index' , compact('discounts' , 'courses'));
    }

    public function store(DiscountRequest $request)
    {
        $this->authorize('create' , Discount::class);

        if (!is_null($request->course))
        {
            $this->discountRepository->special_store($request);
        }else
        {
            $this->discountRepository->store_all($request);
        }

        return redirect()->back();
    }
    public function delete($discount_id)
    {
        $this->authorize('delete' , Discount::class);

        $discount = $this->discountRepository->findByID($discount_id);
        $discount->delete();

        return redirect()->back();
    }

    public function show($id)
    {
        return view('discount::show');
    }

    public function edit($id)
    {
        return view('discount::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
