@extends('Frontend.layout')
@section('title', __('Ngành đào tạo'))
@section('body')
<section class="news-wrapper padding-xs how-study padding-lg">
  <div class="container">
    <div class="row">
      <div class="col-8 col-md-8">
        <h3 style="padding-bottom:20px;text-transform:uppercase;color:#27316b;"><i class="fa fa-newspaper-o"></i> {{ __('Ngành đào tạo') }}</h3>
      </div>
    </div>     
        @if($danhsach_nganh_dao_tao)
        <ul class="row">
        @foreach($danhsach_nganh_dao_tao as $ds)
        <li class="col-sm-4">
          <div class="overly">
            <div class="cnt-block">
              <h3>{{$ds->ten_nganh}}</h3>
              <p>{{$ds->tags}}</p>
            </div>
            <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/nganh-dao-tao/{{ $ds['slug'] }}" class="more"><i class="fa fa-caret-right" aria-hidden="true"></i></a> </div>
          <figure><img src="{{ env('APP_URL') }}assets/frontend/images/default_thumb.jpg" class="img-responsive" alt=""></figure>
        </li>
        @endforeach
      </ul>
      @endif
  </div>
</section>
@section('js')
    <script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/masonry/js/masonry.min.js"></script></script>
@endsection
