@extends('layouts.app')

@section('content')
    
    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="card mb-8 box-shadow">             
              <img class="card-img-top" src="{{asset('images/'.$post['image_path'])}}" alt="Card image cap">
              <div class="card-body" style="direction: rtl;">
                <form method="POST" action="{{action('PostController@update', $post['id'])}}">
                    @csrf 
                  <input type="hidden" name="image_path" value="{{$post['image_path']}}">
                  <textarea class="form-control" id="post_body" required placeholder="" name="body" required>{{$post['body']}}</textarea>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group" style="margin-top: 5px;">
                      <button type="submit" class="btn btn-sm btn-outline-secondary">حفظ التعديلات</button>
                    </div>
                    <small class="text-muted"></small>
                  </div>
                  <input name="_method" type="hidden" value="PATCH">
                </form>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection    