<form action="{{ route('favorites.store') }}" method="POST">
    @csrf

    <input type="hidden" name="favoritable_type" value="{{ $model->getFavoritableType() }}" required>
    <input type="hidden" name="favoritable_id" value="{{ $model->id }}" required>

    <button type="submit" class="btn btn-link fav-btn">
        <i class="bi {{ auth()->user()->hasFavorited($model) ? 'bi-bookmark-star-fill' : 'bi-bookmark-star' }} text-warning fs-1"></i>
    </button>
</form>
