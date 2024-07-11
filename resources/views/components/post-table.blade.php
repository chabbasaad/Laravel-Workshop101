<div>

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1 class="h3">Posts</h1>
                <div>
                    <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
                    <a href="/" class="btn btn-info">Home</a>
                </div>
            </div>
        </div>
        <nav class="nav nav-tabs nav-stacked my-5">
    <a href="{{ route('posts.index') }}" class="nav-link active">All Posts</a>
    <a href="{{ route('posts.archive') }}" class="nav-link">archived Posts</a>

        </nav>
        <div class="row">
            <div class="col-12">
                @if(count($posts) > 0)
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Image</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>

                            <td><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></td>
                            <td>{!! \Illuminate\Support\Str::markdown($post->content) !!}</td>
                            <td>
                                @if($post->image_post)
                                <img src="{{ Storage::url($post->image_post) }}" alt="Post Image" class="img-fluid" style="max-width: 100px;">
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-success" data-toggle="modal" data-target="#createCommentModal">Add Comment</button>
                                {{ count($post->comments) }}

                                @foreach($post->comments as $comment)
                                <div class="comment">
                                    <p>{{ $comment->comment }}</p>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editCommentModal" data-comment="{{ $comment }}">Edit</button>
                                    <form method="POST" action="{{ route('comments.destroy', ['post' => $post->id, 'comment' => $comment->id]) }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            @endforeach

                            </td>
                            <td>
                                @if(\Request::route()->getName() == 'posts.archive')
                                <div class="container">
                                    <div class="row"> <form method="POST" action="{{ route('posts.restore', ['id' => $post->id]) }}" style="display:inline-block;">
                                        @csrf

                                        <button type="submit" class="btn btn-info btn-sm">Restore</button>
                                    </form></div>
                                </div>
                                @else
                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning btn-sm">Archive</button>
                                </form>
                                <form method="POST" action="{{ route('posts.force', ['id' => $post->id]) }}" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @endif


                            </td>
                            {{-- <td>
                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning btn-sm">Archive</button>
                                </form>

                                <form method="POST" action="{{ route('posts.force', ['id' => $post->id]) }}" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-warning" role="alert">
                    No posts found in database.
                </div>
                @endif
            </div>
        </div>
    </div>

  <p> this is a table : {{$type}} </p>
</div>



<!-- Create Comment Modal -->
<div class="modal fade" id="createCommentModal" tabindex="-1" role="dialog" aria-labelledby="createCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCommentModalLabel">Add Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('comments.store', $post->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" id="comment" name="comment" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Comment Modal -->
<div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editCommentForm" method="POST" action="">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editContent">Comment</label>
                        <textarea class="form-control" id="editContent" name="content" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    $('#editCommentModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var comment = button.data('comment');

        var modal = $(this);
        modal.find('#editContent').val(comment.content);
        modal.find('#editCommentForm').attr('action', `/posts/${comment.post_id}/comments/${comment.id}`);
    });
</script>