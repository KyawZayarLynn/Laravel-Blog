<div class="mb-3">
    <div class="dropdown">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            {{isset($currentCategory) ? $currentCategory->name : 'Filter by Category'}}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            @foreach ($categories as $category)
            <li><a class="dropdown-item" href="/?category={{$category->slug}}{{ request('search') ? '&search=' . request('search') : ''}}">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>