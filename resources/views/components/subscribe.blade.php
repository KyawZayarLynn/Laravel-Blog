<section class="container my-4 text-center" id="subscribe">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <h3 class="fw-bold mb-4">Subscribe For new blogs</h3>
      <form action="/subscribe" method="post">
        @csrf
        <div class="mb-3">
          <input placeholder="Email Address" name="email" type="email" class="form-control" autocomplete="false" />
          @error('email')
            <div class="text-danger">{{$message}}</div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Subscribe Now</button>
      </form>
    </div>
  </div>
</section>