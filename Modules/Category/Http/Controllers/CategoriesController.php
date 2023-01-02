<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Http\Requests\categoryRequest;
use Modules\Category\Models\Category;
use Modules\Category\Repository\CategoryRepository;

class CategoriesController extends Controller
{

    public $categoryRepository;
    public function __construct(CategoryRepository $Repository)
    {
        $this->categoryRepository = $Repository;
    }

    public function index()
    {
        $this->authorize('manage' , Category::class);
        $categories = $this->categoryRepository->all();
        return view('category::index' , compact('categories'));
    }
    public function store(categoryRequest $request)
    {
        $this->authorize('manage' , Category::class);
        $this->categoryRepository->store($request);
        return back();
    }
    public function edit(Category $category)
    {
        $this->authorize('manage' , Category::class);
        $categories = $this->categoryRepository->allExceptByID($category->id);
        return view('category::layouts.edit' , compact('category' , 'categories'));
    }

    public function update($categoryID,categoryRequest $request)
    {
        $this->authorize('manage' , Category::class);
        $this->categoryRepository->update($categoryID , $request);

        return back();
    }
    public function destroy($categoryID)
    {
        $this->authorize('manage' , Category::class);
        $this->categoryRepository->delete($categoryID);
        return back();
    }
}
