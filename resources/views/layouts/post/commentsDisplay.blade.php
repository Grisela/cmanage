@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
    <strong>By {{ $comment->user->name }}</strong><span> | {{$comment->created_at->diffForHumans()}}</span>
        <p style="margin-top: 3vh">{{ $comment->body }}</p>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group d-flex justify-content-end">
                <input type="submit" class="btn btn-success" value="Reply" />
            </div>
        </form>
        @include('layouts.post.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach