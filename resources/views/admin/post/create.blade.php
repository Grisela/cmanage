@extends('admin.base')
@section('admincontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                
                <form action="{{ route('home.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                      <label for="title"></label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                      <label for="body"></label>
                      <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                      <input type="file" class="form-control-file" name="post_image">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
        </div>
    </div>
</div>

@endsection