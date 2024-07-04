<div class="container mt-5">
    <!-- He who is contented is rich. - Laozi -->
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
        @csrf

        @if($method !== 'POST')
            @method($method)
        @endif

        <div class="form-group">
            <label for="title" class="font-weight-bold">Title</label>
            <input type="text" name="title" placeholder="Title" class="form-control" value="{{ old('title', $post->title ?? '') }}">
        </div>

        <div class="form-group">
            <label for="content" class="font-weight-bold">Content</label>
            <textarea name="content" placeholder="Content" class="form-control" rows="5">{{ old('content', $post->content ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="thumbnail" class="font-weight-bold">Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
        </div>

        <div class="form-group">
            <img id="image_view" src="{{ (isset($post) && $post->image_post) ? asset('storage/'.$post->image_post) : '' }}" alt="" class="mt-3 img-fluid rounded">
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-primary btn-block">
            {{ $method === 'POST' ? 'Create Post' : 'Update Post' }}
        </button>
    </form>
</div>

<script>
document.getElementById('thumbnail').addEventListener('change', function(){
    const file = this.files[0];
    const fileReader = new FileReader();
    fileReader.onload = function(){
        document.getElementById('image_view').setAttribute('src', fileReader.result);
    }
    fileReader.readAsDataURL(file);
});
</script>