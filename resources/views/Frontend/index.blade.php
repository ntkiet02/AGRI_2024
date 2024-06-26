@extends('Frontend.layout')
@section('title', 'Trang chủ')
@section('body')
<!-- Start Banner Carousel -->
@include('Frontend.widget_banner')
<section class="news-wrapper padding-xs">
  <div class="container">
    <div class="row">
      <div class="col-8 col-md-8">
        <h3 style="padding-bottom:20px;text-transform:uppercase;color: #058B3C;"><i class="fa fa-newspaper-o"></i> {{ __('Tin tức') }}</h3>
      </div>
    </div>
    @if($danhsach_category)
        <ul class="row news-listing" style="height: 5035.97px;">
          @foreach($danhsach_category as $ds)
            <li class="col-xs-6 col-sm-4 grid-item" style="left: 0px; top: 0px;">
              <div class="inner">
                @if(isset($ds['tin_moi']) && $ds['tin_moi'])
                  <img src="{{ env('APP_URL') }}assets/frontend/images/news.gif" alt="{{ $ds['ten'] }}" title="{{ $ds['ten'] }}" class="news_icon">
                @endif
                  @if(isset($ds['id_cat']) && $ds['id_cat'])
                    <span class="tags">{{__( implode(" / ", $ds['id_cat']) )}}</span>
                  @endif
                @if($ds['photos'] && isset($ds['photos'][0]['aliasname']) && $ds['photos'][0]['aliasname'])
                    <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $ds['photos'][0]['aliasname'] }}" class="img-responsive" alt="" style="object-fit: cover;width:360px;height:200px;">
                @else
                    <img src="{{ env('APP_URL') }}assets/frontend/images/default_thumb.jpg" class="img-responsive" alt="">
                @endif
                <div class="cnt-block">
                    <ul class="post-detail">
                      <li><span class="icon-date-icon ico"></span> <span class="bold">{{ App\Http\Controllers\ObjectController::getDate($ds['date_post'], "d/m/Y H:i") }}</li>
                    </ul>
                    <h2 style="height:130px;overflow:hidden;"><a href="{{ env('APP_URL').app()->getLocale() }}/category/{{ $ds['slug'] }}/ct" title="{{ $ds['ten'] }}">{{ Str::limit($ds['ten'],100) }}</a></h2>
                    <p  style="height:100px;overflow:hidden;">{{ $ds['mo_ta'] }}</p>
                    <br />
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/category/{{ $ds['slug'] }}/ct" class="read-more"><span class="icon-play-icon"></span>{{ __('Xem thêm') }}</a>
                </div>
            </div>
          </li>
          @endforeach
        </ul>
        {{ $danhsach_category->withPath(env('APP_URL').app()->getLocale() . '/tin-tuc-su-kien') }}
    @endif
  </div>
</section>
<!-- section ngành đào tạo -->
<section class="news-wrapper padding-xs how-study padding-lg">
  <div class="container">
    <div class="row">
      <div class="col-8 col-md-8">
      @if(app()->getLocale()=='vi')
      <a href="{{ env('APP_URL') }}vi/dao-tao"> <h3 style="padding-bottom:20px;text-transform:uppercase;color: #058B3C;"><i class="fa fa-newspaper-o"></i> {{ __('Ngành đào tạo') }}</h3></a>
      @else
      <a href="{{ env('APP_URL') }}en/training"> <h3 style="padding-bottom:20px;text-transform:uppercase;color: #058B3C;"><i class="fa fa-newspaper-o"></i> {{ __('Ngành đào tạo') }}</h3></a>
      @endif
    </div>
    </div>     
        @if($danhsach_dao_tao)  
        <ul class="row">
        @foreach($danhsach_dao_tao as $ds)
        <li class="col-sm-4" style="margin-top: 25px;">
          <div class="overly">
            <div class="cnt-block ">
              <a style="color:#06b429; font-style:bold; font-size:18px" href="{{ env('APP_URL') }}{{ app()->getLocale() }}/dao-tao/{{$ds['slugtags']}}/{{ $ds['slug'] }}"> {{$ds->ten}} </a>
              <p style="font-size: 16px;">{{__($ds->tags)}}</p>
            </div>
          </div>
          @if($ds['photos'])
          <figure><img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $ds['photos'][0]['aliasname']}}" class="img-responsive" alt="" style="object-fit: cover;width:360px;height:200px;"></figure>
          @else
          <figure><img src="{{ env('APP_URL') }}assets/frontend/images/default_thumb.jpg" class="img-responsive" alt="" style="object-fit: cover;width:360px;height:200px;"></figure>
          @endif

        </li>
        @endforeach
      </ul>
      @endif
  </div>
</section>
<section class="news-wrapper padding-xs how-study padding-lg" style="background-color: white;">
  <div class="container">
    <div class="row">
      <div class="col-8 col-md-8">
        @if(app()->getLocale()=='vi')
        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/hinh-anh-hoat-dong"><h3 style="padding-bottom:20px;text-transform:uppercase;color: #058B3C;"><i class="fa fa-newspaper-o"></i> {{ __('Hình ảnh hoạt động') }}</h3></a>
        @else
        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/activities-image"><h3 style="padding-bottom:20px;text-transform:uppercase;color: #058B3C;"><i class="fa fa-newspaper-o"></i> {{ __('Hình ảnh hoạt động') }}</h3></a>
        @endif
    
    </div>
    </div>     
      @if($danhsach_hinh_anh_hoat_dong)  
        <ul class="row">
          @foreach($danhsach_hinh_anh_hoat_dong as $b)
            @if($b['photos'])
             @foreach($b['photos'] as $p)
              <li class="col-sm-3" style="margin-top: 10px;">
                <a class="galleryItem" href="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}"> 
                  <figure><img style="object-fit: cover;height: 250px;width:300px; margin-left:13px;margin-top: 13px;" src="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}" alt="{{ $b['title'] }}" title="{{ $b['title'] }}"" class="img-responsive" alt=""></figure>
                </a> 
             </li>
             @endforeach
            @endif
          @endforeach
          @if($danhsach_hinh_anh_hoat_dong2)
          @foreach($danhsach_hinh_anh_hoat_dong2 as $b)
            @if($b['photos'])
             @foreach($b['photos'] as $p)
              <li class="col-sm-3" style="margin-top: 10px;">
                <a class="galleryItem" href="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}"> 
                  <figure><img style="object-fit: cover;height: 250px;width:300px; margin-left:13px;margin-top: 13px;" src="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}" alt="{{ $b['title'] }}" title="{{ $b['title'] }}"" class="img-responsive" alt=""></figure>
                </a> 
             </li>
             @endforeach
            @endif
          @endforeach
          @endif
        </ul>
      @endif
  </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/masonry/js/masonry.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  $("#owl-demo").owlCarousel({
      autoPlay: 3000,
      items : 1,
      center:true,
      loop: true
  });
});
</script>
@endsection