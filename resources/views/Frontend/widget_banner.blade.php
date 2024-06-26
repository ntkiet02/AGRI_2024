@php
    $locale = app()->getLocale();
    $banners = App\Models\Banner::where('status','=',1)->orderBy('order', 'asc')->get()->toArray();
@endphp
<!-- Start Banner Carousel no-repeat center top / cover; -->
<!-- <div style="text-align: center; margin-top:2px">
  <span style="font-size: 28px;">{{__('Chính trực - Tận tâm - Sáng tạo')}}</span>
</div> -->
<div class="centered-text">
  <span>{{__('Chính trực - Tận tâm - Sáng tạo')}}</span>
</div>
<div class="banner-outer" style="margin-top:2px;">
  <div class="banner-slider"> 
    @foreach($banners as $b)
    <div class="slide1">
          @php
            $link = $b['url'] ? $b['url'] : env('APP_URL');
          @endphp
          @if($link) <a href="{{ $link }}"> @endif
           <img style="display: block; height:100%;width:100%" src="{{ env('APP_URL') }}storage/images/origin/{{ $b['photos'][0]['aliasname'] }}" alt="{{ $b['title'] }}" title="{{ $b['title'] }}" />
          @if($link) </a> @endif
    </div>   
  @endforeach
</div>
<!-- End Banner Carousel -->

