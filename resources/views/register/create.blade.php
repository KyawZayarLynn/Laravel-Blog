<x-layout>
  <div class="container">
    <div class="row">
      <h1>Register Form</h1>
      <form action="/register" method="post" class="my-3">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}" id="" placeholder="Enter your name">
            @error('name')
              <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{old('email')}}" id="" placeholder="Enter your email address">
            @error('email')
              <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="{{old('username')}}" id="" placeholder="Enter your username">
            @error('username')
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
        <div class="mb-3">
            <label for="" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirmPassword" id="" placeholder="Enter your password">
            @error('confirmPassword')
              <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</x-layout>