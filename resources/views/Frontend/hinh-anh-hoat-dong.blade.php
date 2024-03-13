@extends('Frontend.layout')
@section('title', __('Hình ảnh hoạt động'))
@section('body')
<div class="col-12">
  <div class="inner-banner contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="content" style="width:100%;">
                    <p style="font-size:40px;color: #058B3C;">Hình ảnh hoạt động</p>     
                </div>
            </div>
        </div>
      </div>
  </div>
</div>
<section class="campus-tour padding-lg">
  <ul style=" display:block; margin-left: 5%;margin-right:5%;" class="gallery clearfix">
    @foreach($danhsach as $b)
      @if($b['photos'])
        @foreach($b['photos'] as $p)
        <li>
          <div class="overlay">
            <a class="galleryItem" href="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}"><span class="icon-enlarge-icon"></span></a> 
          </div>
          <figure><img style="height: 250px;width:300px; margin-left:13px;margin-top: 13px; margin-right:13px;" src="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}" alt="{{ $b['title'] }}" title="{{ $b['title'] }}"" class="img-responsive" alt=""></figure>
        </li>
        @endforeach
      @endif
    @endforeach
  </ul>
</section>
<div style="display: block;text-align:center">{{$danhsach->links()}}</div>
@endsection
@section('js')
    <script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/masonry/js/masonry.min.js"></script></script>
@endsection
