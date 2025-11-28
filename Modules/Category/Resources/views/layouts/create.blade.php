<div class="col-4 bg-white">
    <p class="box__title">Create New Category</p>

    <form action="{{ route('dashboard.categories.store') }}" method="post" class="padding-30">
        @csrf

        <input name="title" required type="text" placeholder="Category Name" class="text">

        <input name="slug" required type="text" placeholder="Category Slug (English Name)" class="text">

        <p class="box__title margin-bottom-15">Select Parent Category</p>

        <select name="parent_id" id="parent_id">
            <option value="">None</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-webamooz_net">Add Category</button>
    </form>
</div>
