<x-admin-layout>
  <h3>Blogs list</h3>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Slug</th>
        <th scope="col">Category</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($blogs as $blog)
      <tr>
        <th scope="row">{{$blog->id}}</th>
        <td>{{$blog->title}}</td>
        <td>{{$blog->slug}}</td>
        <td>{{$blog->category->name}}</td>
        @if (auth()->user()->can('edit',$blog)) 
          <td>
            <a href="/admin/blogs/{{$blog->id}}/edit" class="btn btn-warning">Edit</a>
          </td>
        @endif
        @if (auth()->user()->can('delete',$blog))
          <td>
            <form action="/admin/blogs/{{$blog->id}}/destroy" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </td>
        @endif
      </tr>
      @endforeach
      {{$blogs->links()}}
    </tbody>
  </table>
</x-admin-layout>