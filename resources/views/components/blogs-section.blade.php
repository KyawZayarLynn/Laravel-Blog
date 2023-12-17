@props(['blogs','categories','currentCategory'])
<section class="container text-center" id="blogs">
  <h1 class="display-5 fw-bold mb-4">Blogs</h1>
  <x-category/>
  <form action="/" class="mt-3 ms-3 mb-3">
    <input 
    value="{{request('search')}}" 
    name="search" 
    type="text" 
    placeholder="search here...."
    >
    <input 
    value="{{request('category')}}" 
    name="category" 
    type="hidden" 
    >
    <button class="btn btn-primary" type="submit">search</button>
  </form>
  <div class="row">
    @forelse ($blogs as $blog)
    <div class="col-md-4 mb-4">
      <x-blog-card :blog="$blog" />
    </div>
    @empty
      <h4>No blogs found!!</h4>
    @endforelse
    {{$blogs->links()}}
  </div>
</section>