@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
      @if (!Auth::guest())
          
        @if (Auth::user()->rolecheck != 1)

          <h1 style="text-align:center;margin-top:10vh;font-weight:bolder;">-ACCESS DENIED-</h1>

          @else
              
              <form action="{{ route('home.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                  <div class="form-group">
                    <label for="title"></label>
                  <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" aria-describedby="helpId">
                  </div>
                  <div class="form-group">
                    <label for="body"></label>
                  <textarea class="form-control" name="body" id="body" rows="3" >{{$post->body}}</textarea>
                  </div>
                  <div class="form-group">
                    <input type="file" class="form-control-file" name="post_image">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </form>
          @endif      
      
      @else
      
      <h1 style="text-align:center;margin-top:10vh;font-weight:bolder;">-ACCESS DENIED-</h1>    
          
      @endif
          </div>
    </div>
</div>

@endsection    

