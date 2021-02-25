@extends('layouts.app')

@section('content')  
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        @isset($posts)            
        @foreach ($posts as $post)
        <div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <img class="card-img-top" src="{{asset('images/'.$post['image_path'])}}" alt="Card image cap" style="height: 250px">
            <div class="card-body" >
              <p class="card-text" style="text-align: right;direction:  rtl;">
                <small>@ {{$post->user['name']}}</small><br>
                {{Str::limit($post['body'], 80)}}
              </p>
            </div>
            <div class="card-footer">  
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a class="btn btn-sm btn-outline-secondary" href="{{action('PostController@show', $post['id'])}}">عرض</a>
                  <a class="btn btn-sm btn-outline-secondary" href="#">{{$post['likes_count']}}</a>
                </div>
                <small class="text-muted">{{$post['created_at']}}</small>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @endisset
      </div>
      @isset($posts)
      {{ $posts->links("pagination::bootstrap-4") }}          
      @endisset
    </div>
  </div>
@endsection
