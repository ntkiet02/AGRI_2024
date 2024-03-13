
@extends('Frontend.layout')
@section('title', 'Giới thiệu - Nhân sự')
@section('css')
<style type="text/css" media="screen">
  .noi-dung h2 {
    padding: 20px 0px;
    color: #27316b;
    margin-top: 10px;
    margin-bottom: 10px;
    text-align:center;  
  }
  .noi-dung h3 {
      padding: 5px;
      text-align: center;
      color: #4472c4;
    }
    span{color:black; font-style: normal;}
    .ava{
      display: block; width:100%;height:100%;
    }

</style>
@endsection
@section('body')
<div class="col-12">
  <div class="inner-banner contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="content" style="width:100%; text-align:center">
                  @if($tamp =='ban-lanh-dao-khoa')
                    <h2 style="color: #058B3C;">  
                    {{ __('Lãnh Đạo Khoa') }}
                  </h2>
                  @elseif($tamp =='van-phong-khoa')
                  <h2 style="color: #058B3C;">  
                    {{ __('Văn Phòng Khoa') }}
                  </h2>
                  @elseif($tamp =='bo-mon-cong-nghe-thuc-pham')
                  <h2 style="color: #058B3C;">  
                    {{ __('Bộ môn Công nghệ Thực phẩm') }}
                  </h2>
                  @elseif($tamp =='bo-mon-nuoi-trong-thuy-san')
                  <h2 style="color: #058B3C;">  
                    {{ __('Bộ môn Nuôi trồng Thủy sản') }}
                  </h2>
                  @elseif($tamp =='bo-mon-cong-nghe-sinh-hoc')
                  <h2 style="color: #058B3C;">  
                    {{ __('Bộ môn Công nghệ Sinh Học') }}
                  </h2>
                  @elseif($tamp =='bo-mon-chan-nuoi-thu-y')
                  <h2 style="color: #058B3C;">  
                    {{ __('Bộ môn Chăn nuôi Thú y') }}
                  </h2>
                  @elseif($tamp =='bo-mon-khoa-hoc-cay-trong')
                  <h2 style="color: #058B3C;">  
                    {{ __('Bộ môn Khoa học Cây trồng') }}
                  </h2>
                  @elseif($tamp =='bo-mon-phat-trien-nong-thon-va-qltntn')
                  <h2 style="color: #058B3C;">  
                    {{ __('Bộ môn Phát triển Nông thôn và QLTNTN') }}
                  </h2>
                  @else
                  <h2 style="color: #058B3C;">  
                  {{ __('Tổng quan') }}
                  </h2>
                  @endif  
                </div>
            </div>
        </div>
      </div>
  </div>
</div>
<section >
  <div class="container noi-dung">
    <h2 style="color: #058B3C; font-style:bold">{{ __('Tổng quan') }}</h2>
    <br/>
    {!! $noi_dung !!}
  </div>
</section>
<section class="testimonial-outer">
  <div class="container noi-dung">
    <h2 style="color: #058B3C; font-style:bold">{{ __('Nhân sự') }}</h2>
    <br />
      @if($danhsach_lanh_dao)
        @foreach($danhsach_lanh_dao as $ds)
          <ul class="row testimonials" style="position: relative; height: 3876px;">
              @if($ds['thu_tu']>=1 && $ds['thu_tu']<=2)
                @php
                  $image = isset($ds['photos'][0]['aliasname'])  ? $ds['photos'][0]['aliasname'] : '';
                @endphp
                <li class="col-xs-12 col-sm-13 col-md-12 grid-item" >
                    <div class="quotblock">
                      <div style=" width: 100px;height: 100px;border-radius: 50%;overflow: hidden; margin-bottom: 10px;text-align:center;margin-left:auto;margin-right:auto;">
                        <div style="height: 100%;object-fit: cover;width:100%; ">
                          @if($image)
                            <img src="{{ env('APP_URL') }}storage/images/origin/{{ $image }}"  class="ava" title="{{ $ds['ho_ten'] }}">     
                          @endif
                        </div>
                      </div>
                        {{ $ds['title'] }}       
                        <h3>{{ $ds['ho_ten'] }}</h3></a>
                        @if($ds['chuc_vu'])
                          <span class="desig">{{ __('Chức vụ') }}: {{ $ds['chuc_vu'] }}</span>  
                          @else
                          <span class="desig" >{{ __('Chức vụ') }}: Giảng viên</span>
                        @endif
                        @if($ds['hoc_vi'])
                          <span class="desig">{{ __('Học vị') }}: {{ $ds['hoc_vi'] }}</span>
                          @else
                          <span class="desig">{{ __('Học vị') }}:</span>
                        @endif
                        @if($ds['chuyen_nganh'])
                          <span class="desig">{{ __('Chuyên ngành') }}: {{ $ds['chuyen_nganh'] }}</span>
                          @else
                          <span class="desig">{{ __('Chuyên ngành') }}: </span>
                        @endif
                        @if($ds['email'])
                          <span class="desig">{{ __('Email') }}: <a style="color: black;" href="mailto:{{ $ds['email'] }}">{{ $ds['email'] }}</a></span>
                          @else
                          <span class="desig">{{ __('Email') }}: </span>
                        @endif  
                        @if($ds['dien_thoai'])
                          <span class="desig">{{ __('Điện thoại') }}: <a style="color: black;"  href="tel:{{ $ds['dien_thoai'] }}">{{ $ds['dien_thoai'] }}</a></span>
                          @else
                          <span class="desig">{{ __('Điện thoại') }}: </span>        
                          <span class="desig">&nbsp;</span>
                        @endif
                        <a style="color:black;"  href="{{ env('APP_URL').app()->getLocale() }}/nhan-su/xem-truc-tuyen/{{$ds['_id']}}/0" data-toggle="modal" data-target="#xemdinhkem" class="view_online">{{ __('Lý lịch khoa học') }}</a></span>
                    </div>
                </li>
              @endif 
          </ul>
        @endforeach
      @endif
      <ul class="row testimonials" style="position: relative; height: 3876px;">
        @foreach($danhsach_lanh_dao as $ds)
          @if($ds['thu_tu']>2 && $ds['thu_tu']<=5)
          @php
            $image = isset($ds['photos'][0]['aliasname'])  ? $ds['photos'][0]['aliasname'] : '';
          @endphp
            <li class="col-xs-6 col-sm-6 col-md-6 grid-item">
              <div class="quotblock">
                <div style=" width: 100px;height: 100px;border-radius: 50%;overflow: hidden; margin-bottom: 10px;text-align:center;margin-left:auto;margin-right:auto;">
                  <div style="height: 100%;object-fit: cover;width:100%; ">
                    @if($image)
                      <img src="{{ env('APP_URL') }}storage/images/origin/{{ $image }}"  class="ava" title="{{ $ds['ho_ten'] }}">     
                    @endif
                  </div>
                </div>
                  {{ $ds['title'] }}       
                  <h3>{{ $ds['ho_ten'] }}</h3></a>
                  @if($ds['chuc_vu'])
                    <span class="desig">{{ __('Chức vụ') }}: {{ $ds['chuc_vu'] }}</span>  
                    @else
                    <span class="desig" >{{ __('Chức vụ') }}: Giảng viên</span>
                  @endif
                  @if($ds['hoc_vi'])
                    <span class="desig">{{ __('Học vị') }}: {{ $ds['hoc_vi'] }}</span>
                    @else
                    <span class="desig">{{ __('Học vị') }}: </span>
                  @endif
                  @if($ds['chuyen_nganh'])
                    <span class="desig">{{ __('Chuyên ngành') }}: {{ $ds['chuyen_nganh'] }}</span>
                    @else
                    <span class="desig">{{ __('Chuyên ngành') }}: </span>
                  @endif
                  @if($ds['email'])
                    <span class="desig">{{ __('Email') }}: <a style="color: black;" href="mailto:{{ $ds['email'] }}">{{ $ds['email'] }}</a></span>
                    @else
                    <span class="desig">{{ __('Email') }}: </span>
                  @endif  
                  @if($ds['dien_thoai'])
                    <span class="desig">{{ __('Điện thoại') }}: <a style="color: black;"  href="tel:{{ $ds['dien_thoai'] }}">{{ $ds['dien_thoai'] }}</a></span>
                    @else
                    <span class="desig">{{ __('Điện thoại') }}: </span>
                      
                    <span class="desig">&nbsp;</span>
                  @endif
                  <a style="color:black;"  href="{{ env('APP_URL').app()->getLocale() }}/nhan-su/xem-truc-tuyen/{{$ds['_id']}}/0" data-toggle="modal" data-target="#xemdinhkem" class="view_online">{{ __('Lý lịch khoa học') }}</a></span> 
              </div>
            </li>
          @endif
        @endforeach
      </ul>    
    @if($danhsach_giang_vien)
    <br/>
    <ul class="row testimonials" style="position: relative;height:5006px;">
      @foreach($danhsach_giang_vien as $ds)
      @php
        $image = isset($ds['photos'][0]['aliasname'])  ? $ds['photos'][0]['aliasname'] : '';
      @endphp
      <li class="col-xs-6 col-sm-6 col-md-4 grid-item">
        <div >
          <div style=" width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        margin-bottom: 10px;
        text-align:center;
        margin-left:auto;
        margin-right:auto;
        ">
        <div style="height: 100%;object-fit: cover;width:100%; ">
          @if($image)
            <img src="{{ env('APP_URL') }}storage/images/origin/{{ $image }}" class="ava" title="{{ $ds['ho_ten'] }}">     
          @endif</div></div>
          {{ $ds['title'] }}       
          <h3>{{ $ds['ho_ten'] }}</h3></a>
          @if($ds['chuc_vu'])
            <span class="desig">{{ __('Chức vụ') }}: {{ $ds['chuc_vu'] }}</span>
            @else
            <span class="desig">{{ __('Chức vụ') }}: Giảng viên</span>
          @endif
          @if($ds['hoc_vi'])
            <span class="desig">{{ __('Học vị') }}: {{ $ds['hoc_vi'] }}</span>
            @else
            <span class="desig">{{ __('Học vị') }}: </span>
          @endif
          @if($ds['chuyen_nganh'])
            <span class="desig">{{ __('Chuyên ngành') }}: {{ $ds['chuyen_nganh'] }}</span>
            @else
            <span class="desig">{{ __('Chuyên ngành') }}: </span>
          @endif
          @if($ds['email'])
            <span class="desig">{{ __('Email') }}: <a style="color:black;" href="mailto:{{ $ds['email'] }}">{{ $ds['email'] }}</a></span>
            @else
            <span class="desig">{{ __('Email') }}: </span>
          @endif  
           @if($ds['dien_thoai'])
            <span class="desig">{{ __('Điện thoại') }}: <a style="color:black;" href="tel:{{ $ds['dien_thoai'] }}">{{ $ds['dien_thoai'] }}</a></span>
            @else
            <span class="desig">{{ __('Điện thoại') }}: </span> 
            <span class="desig">&nbsp;</span>
          @endif
          <a style="color:black;"  href="{{ env('APP_URL').app()->getLocale() }}/nhan-su/xem-truc-tuyen/{{$ds['_id']}}/0" data-toggle="modal" data-target="#xemdinhkem" class="view_online">{{ __('Lý lịch khoa học') }}</a></span>
        </div>
      </li>   
      @endforeach
    </ul>
    @endif
    <br /> 
</section>
<div id="xemdinhkem" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="width:95%;">
        <div class="modal-content" style="height:800px !important;">
            <div class="modal-header">
                <h4 class="modal-title" id="myExtraLargeModalLabel">{{ __('Thông tin chi tiết') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="chitiet" class="modal-body" style="height:700px; overflow:hidden;">
                {{ __('Xin chào') }}
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
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
