<x-layout>
  <div class="container">
    <h3>Edit Comment</h3>
    <form action="/comments/{{$comment->id}}/update" method="post">
      @csrf
      @method('patch')
    <textarea class="form-control mb-3" name="body" id="" cols="30" rows="10" placeholder="comment here...">{{$comment->body}}</textarea>
    @error('body')
      <p class="text-danger">{{$message}}</p>
    @enderror
    <button class="btn btn-primary mb-3">Update</button>
    </form>
  </div>
</x-layout>