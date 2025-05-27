@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    @if(session('error') || session('success'))
        @php
            $type = session('error') ? 'error' : 'success';
            $message = session($type);
            $bgColor = $type === 'error' ? 'bg-red-500' : 'bg-green-500';
            $id = $type . 'Message';
            $closeFunction = 'close' . ucfirst($type) . 'Message';
        @endphp

        <div id="{{ $id }}" class="{{ $bgColor }} text-white p-4 rounded-lg mb-6 relative">
            <span>{{ $message }}</span>
            <button class="absolute right-5 text-white font-bold" onclick="{{ $closeFunction }}()">X</button>
        </div>

        <script>
            function {{ $closeFunction }}() {
                document.getElementById('{{ $id }}').classList.add('hidden');
            }

            setTimeout(function() {
                var el = document.getElementById('{{ $id }}');
                if (el) el.classList.add('hidden');
            }, 5000);
        </script>
    @endif

    <div class="bg-white p-8 rounded shadow-lg">
        @if($product->image)
            <img src="{{ asset('storage/products/' . $product->image) }}"
     alt="{{ $product->name }}"
     style="max-width: 400px; width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;"
     class="rounded mb-4 object-cover">

        @endif

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
            <p class="text-sm text-gray-500 text-justify">{{ $product->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }}</p>
        </div>
        <p class="mt-4 text-gray-700">{{ $product->description }}</p>
    </div>

  @if(auth()->check() && auth()->user()->role === 'buyer')
<div class="mt-5">
    <h5 class="mb-3">Tinggalkan Komentar</h5>
    <form method="POST" action="/products/{{ $product->id }}/comments">
        @csrf

        {{-- ⭐⭐⭐⭐⭐  –– rating --}}
        <style>
    .star-rating {
        direction: rtl;
        display: inline-flex;
        font-size: 1.5rem;
    }
    .star-rating input {
        display: none;
    }
    .star-rating label {
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
    }
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: gold;
    }
</style>

<div class="mb-3">
    <label class="form-label d-block mb-1">Rating:</label>
    <div class="star-rating">
        @for($i = 5; $i >= 1; $i--)
            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating', 5) == $i ? 'checked' : '' }}>
            <label for="star{{ $i }}">&#9733;</label> {{-- ★ --}}
        @endfor
    </div>
</div>


        {{-- komentar --}}
        <textarea name="comment" rows="3" class="form-control mb-2"
                  placeholder="Tulis komentarmu…" required></textarea>

        <div class="d-flex justify-content-between">
            <button type="reset" class="btn btn-success">Cancel</button>
            <button class="btn btn-danger">Kirim</button>
        </div>
    </form>
</div>
@endif



    <div class="mt-4">
    <h5 class="mb-3">Komentar</h5>

    @forelse($product->comments as $comment)
<div class="card mb-3">
  <div class="card-body">
      {{-- header: avatar, nama, tanggal --}}
      <div class="d-flex align-items-center mb-2">
          <i class="fas fa-user-circle fa-2x text-secondary me-2"></i>
          <div>
              <strong>{{ $comment->user->name }}</strong><br>
              <small class="text-muted">
                  {{ $comment->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }}
              </small>
          </div>
      </div>

     <div class="mb-2 text-warning">
    @for($i = 1; $i <= 5; $i++)
        <span style="font-size: 1.2rem;">{{ $i <= $comment->rating ? '★' : '☆' }}</span>
    @endfor
</div>


      @if(auth()->check() && auth()->id() == $comment->user_id && request('edit') == $comment->id)
          {{-- ====== FORM EDIT ====== --}}
          <form method="POST" action="{{ route('comment.update', $comment) }}">
              @csrf @method('PUT')

              {{-- rating editable --}}
              <div class="rating mb-2">
                  @for($i = 5; $i >= 1; $i--)
                      <input type="radio" id="editStar{{ $comment->id }}_{{ $i }}"
                             name="rating" value="{{ $i }}"
                             {{ $comment->rating == $i ? 'checked' : '' }}>
                      <label for="editStar{{ $comment->id }}_{{ $i }}"></label>
                  @endfor
              </div>

              <div class="input-group mb-2">
                  <input name="comment" class="form-control"
                         value="{{ old('comment',$comment->comment) }}" required>
              </div>

              <button class="btn btn-success btn-sm me-1"><i class="fas fa-check"></i></button>
              <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i></a>
          </form>
      @else
          <p class="mt-2">{{ $comment->comment }}</p>

          @if(auth()->check() && auth()->id() == $comment->user_id)
              <a href="{{ url()->current() }}?edit={{ $comment->id }}"
                 class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-pen"></i></a>

              <form method="POST" action="{{ route('comment.destroy',$comment) }}" class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
              </form>
          @endif
      @endif
  </div>
</div>
@empty
    <p class="text-muted">Belum ada komentar.</p>
@endforelse


</div>

</div>
@endsection
