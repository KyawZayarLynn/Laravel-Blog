<x-layout>
  <!-- single blog section -->
  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <img src="{{$blog->photo}}" class="card-img-top" alt="..." />
        <h3 class="my-3 text-center">{{$blog->title}}</h3>
        <div class="text-center">
          <div>Author - <a href="/users/{{$blog->author->username}}">{{$blog->author->name}}</a></div>
          <div><a href="/categories/{{$blog->category->slug}}"><span class="badge bg-primary">Category - {{$blog->category->name}}</span></a></div>
          <div class="text-secondary">{{$blog->created_at->diffForHumans()}}</div>
          <div>
            <form action="/blogs/{{$blog->slug}}/handle-subscriptions" method="post">
              @csrf
              @if ($blog->isSubscribedBy(auth()->user()))
              <button type="submit" class="btn btn-danger">unsubscribe</button>
              @else
              <button type="submit" class="btn btn-warning">subscribe</button>
              @endif
            </form>
          </div>
        </div>
        <p class="lh-md mt-3">
          {!!$blog->body!!}
        </p>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="my-3">
          <form action="/blogs/{{$blog->slug}}/comments" method="POST">
            @csrf
            <textarea class="form-control" name="body" id="" cols="30" rows="10" placeholder="comment here..."></textarea>
            <button type="submit" class="mt-3 btn btn-primary">Comment</button>
          </form>
        </div>

        @if (auth()->user()->is_admin)
        @foreach ($blog->comments()->with('user')->orderby('created_at','desc')->get() as $comment)
        @if (!$comment->status)
        <div>
          <h3>
            {{$comment->user->name}}
          </h3>
          <p>
            {{$comment->body}}
          </p>
          <p>{{$comment->created_at->diffForHumans()}}</p>
          <div class="d-flex">
            @if (auth()->user()->can('edit',$comment))
            <a href="/comments/{{$comment->id}}/edit" type="submit" class="btn btn-info mx-3">Edit</a>
            @endif
            @if (auth()->user()->can('delete',$comment))
            <form action="/comments/{{$comment->id}}" method="POST">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @endif
            @if (auth()->user()->is_admin)
            <form action="/comments/{{$comment->id}}/handle-publish" method="post">
              @csrf
              @method('patch')
              <button class="btn btn-{{$comment->status ? 'secondary' : 'success'}} mx-3" type="submit">
                {{$comment->status ? 'Unpublish' : 'Publish'}}
              </button>
            </form>
            @endif
          </div>
        </div>
        @endif
        @endforeach
        @endif

        @foreach ($blog->comments()->with('user')->where('status',true)->orderby('created_at','desc')->get() as $comment)
        <div>
          <h3>
            {{$comment->user->name}}
          </h3>
          <p>
            {{$comment->body}}
          </p>
          <p>{{$comment->created_at->diffForHumans()}}</p>
          <div class="d-flex">
            @if (auth()->user()->can('edit',$comment))
            <a href="/comments/{{$comment->id}}/edit" type="submit" class="btn btn-info mx-3">Edit</a>
            @endif
            @if (auth()->user()->can('delete',$comment))
            <form action="/comments/{{$comment->id}}" method="POST">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @endif
            @if (auth()->user()->is_admin)
            <form action="/comments/{{$comment->id}}/handle-publish" method="post">
              @csrf
              @method('patch')
              <button class="btn btn-{{$comment->status ? 'secondary' : 'success'}} mx-3" type="submit">
                {{$comment->status ? 'Unpublish' : 'Publish'}}
              </button>
            </form>
            @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <x-subscribe />

  <x-blogs_you_may_like_session :randomBlogs="$randomBlogs" />
</x-layout>