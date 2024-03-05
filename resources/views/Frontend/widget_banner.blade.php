@php
    $locale = app()->getLocale();
    $banners = App\Models\Banner::where('locale','=',$locale)->where('status','=',1)->orderBy('order', 'asc')->get()->toArray();
@endphp

@if($banners && count($banners) > 0)
<section>
  <div style="align-items: center;">
  <div id="owl-demo" class="owl-carousel owl-theme">
      @foreach($banners as $b)
        @php
          $link = $b['url'] ? $b['url'] : env('APP_URL');
        @endphp
        @if($link) <a href="{{ $link }}"> @endif
          <div class="item"><img src="{{ env('APP_URL') }}storage/images/origin/{{ $b['photos'][0]['aliasname'] }}" alt="{{ $b['title'] }}" title="{{ $b['title'] }}" /> </div>
        @if($link) </a> @endif
      @endforeach
    </div>
  </div>
</section>
@endif
