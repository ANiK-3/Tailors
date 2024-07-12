<div class="container">
  <div class="row gap-4">
    @foreach($tailors as $tailor)
    <div class="col">
      <a href="{{ route('tailor.show', $tailor->id) }}" class="card-link">
        <div class="card" style="width: 16rem;">
          <img src="{{ $tailor->shop_image ? asset('/storage/' . $tailor->shop_image) : asset('/storage/images/' . 'default_tailor.jpeg') }}" class="img-fluid card-img-top" alt="Card Shop Image">
          <div class="card-body">
            <h5 class="card-title">{{ $tailor->shop_name }}</h5>
            <p class="card-text">{{ $tailor->bio }}</p>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>
