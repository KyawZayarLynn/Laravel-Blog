<x-layout>
  <div class="container">
    <div class="row">
      <h1>Login Form</h1>
      <form action="/login" method="post" class="my-3">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{old('email')}}" id="" placeholder="Enter your email address">
            @error('email')
              <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="" placeholder="Enter your password">
            @error('password')
              <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
</x-layout>