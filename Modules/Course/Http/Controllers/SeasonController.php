<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Course\Http\Requests\SeasonRequest;
use Modules\Course\Repository\CourseRepository;
use Modules\Course\Repository\SeasonRepository;

class SeasonController extends Controller
{
    private $seasonRepository;
    public function __construct(SeasonRepository $seasonRepository)
    {
        $this->seasonRepository = $seasonRepository;
    }
    public function store( SeasonRequest $request ,$course_id)
    {
        $this->authorize('createSeason' , (new CourseRepository())->findById($course_id));
        $this->seasonRepository->store($request ,$course_id );
//        new feedBack();
        return redirect()->back();
    }
    public function edit($seasonId)
    {
        $season = $this->seasonRepository->findById($seasonId);
        $this->authorize('editSeason' , $season);
        return view('course::seasons.editDetails' , compact('season'));
    }
    public function update(SeasonRequest $request ,$seasonId)
    {
        $this->seasonRepository->update($seasonId , $request);
        return redirect()->back();
    }
}
