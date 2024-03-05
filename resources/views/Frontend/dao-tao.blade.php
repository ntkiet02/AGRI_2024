
@extends('Frontend.layout')
@section('title', __('Đào tạo'))
@section('body')
<section class="news-wrapper padding-xs how-study padding-lg">
  <div class="container">
    <div class="row">
      <div class="col-8 col-md-8">
        <h3 style="padding-bottom:20px;text-transform:uppercase;color:#27316b;"><i class="fa fa-newspaper-o"></i> {{ __('Đào tạo') }}</h3>
      </div>
    </div>     
        @if($danhsach)
        <ul class="row">
        @foreach($danhsach as $ds)
        <li class="col-sm-4" style="margin-top: 25px;">
          <div class="overly">
            <div class="cnt-block">
              <a style="color:aliceblue; font-style:bold; font-size:25px" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/{{ $ds['slug'] }}"> {{$ds->ten}} </a>
              <p style="font-size: 20px;">{{$ds->tags}}</p>
            </div>
          </div>
          <figure><img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $ds['photos'][0]['aliasname'] }}" class="img-responsive" alt="" style="width:360px;height:200px;"></figure>
        </li>
        @endforeach
      </ul>
      @endif
  </div>
</section>
@endsection
@section('js')
    <script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/masonry/js/masonry.min.js"></script></script>
@endsection
