@props(['blog' => null,'categories'])
<form action="{{$blog ? '/admin/blogs/'. $blog->id .'/update' : '/admin/blogs/store'}}" 
  method="post"
  enctype="multipart/form-data"
  >
  @csrf
  @if ($blog)
  @method('PUT')
  @endif
  <div class="form-group mb-3">
    <label >Blog title</label>
    <input type="text" value="{{$blog?->title}}" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title">
    @error('title')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  @if ($blog)
    <img src="{{$blog->photo}}" alt="" width="200" height="100">
  @endif
  <div class="form-group mb-3">
    <label >Blog Photo</label>
    <input type="file" name="photo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    @error('photo')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group mb-3">
    <label >Blog slug</label>
    <input type="text" value="{{$blog?->slug}}" name="slug" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter slug">
    @error('slug')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group mb-3">
    <label >Blog body</label>
    <textarea name="body" id="blog-textarea" class="form-control" id="" cols="30" rows="10">{{$blog?->body}}</textarea>
    @error('body')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group mb-3">
    <label >Blog category</label>
    <select name="category_id" id="">
      @foreach ($categories as $category)
      <option {{$category->id == $blog?->category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
      @endforeach
    </select>
    @error('category_id')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group mb-3">
    <label >New Category</label>
    <input type="text" value="" name="new_cat" class="form-control" aria-describedby="emailHelp" placeholder="Enter new category">
    @error('new_cat')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group mb-3">
    <label >New Category Slug</label>
    <input type="text" value="" name="new_cat_slug" class="form-control" aria-describedby="emailHelp" placeholder="Enter new category">
    @error('new_cat_slug')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">{{$blog ? 'Update' : 'Create'}}</button>
</form>