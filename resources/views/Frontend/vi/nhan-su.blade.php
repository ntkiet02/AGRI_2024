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
</style>
@endsection
@section('body')
<section class="testimonial-outer">
  <div class="container noi-dung">
    <h2>{{ __('Nhân sự') }}</h2>
    <hr />
    @if($danhsach)
    <ul class="row testimonials" style="position: relative;">
      @foreach($danhsach as $ds)
      @php
        $image = isset($ds['photos'][0]['aliasname'])  ? $ds['photos'][0]['aliasname'] : '';
      @endphp
      <li class="col-xs-6 col-sm-6 col-md-4 grid-item">
        <div class="quotblock">
          @if($image)
            <img src="{{ env('APP_URL') }}storage/images/origin/{{ $image }}" class="img-responsive" title="{{ $ds['ho_ten'] }}">
          @endif
          <h3>{{ $ds['ho_ten'] }}</h3>
          @if($ds['chuc_vu'])
            <span class="desig">{{ __('Chức vụ') }}: {{ $ds['chuc_vu'] }}</span>
          @endif
          @if($ds['email'])
            <span class="desig">{{ __('Email') }}: <a href="mailto:{{ $ds['email'] }}">{{ $ds['email'] }}</a></span>
          @endif
           @if($ds['dien_thoai'])
            <span class="desig">{{ __('Điện thoại') }}: <a href="tel:{{ $ds['dien_thoai'] }}">{{ $ds['dien_thoai'] }}</a></span>
          @else
            <span class="desig">&nbsp;</span>
          @endif
        </div>
      </li>
      @endforeach
    </ul>
    @endif
    <br />
    {{--
    <h3>Nghiên cứu viên</h3>
    <hr />
    <ul class="row testimonials" style="position: relative; height: 3876px;">
      <li class="col-xs-6 col-sm-4 grid-item">
        <div class="quotblock"><img src="{{ env('APP_URL') }}assets/frontend/images/nhansu/ddduong.jpg" class="img-responsive" title="Đàm Đức Dương">
          <h3>Ths. ĐÀM ĐỨC DƯƠNG</h3>
          <span class="desig">Chức vụ: Nghiên cứu Viên</span>
          <span class="desig">Di động: <a href="tel:0943 158 240">0943 158 240</a></span>
          <span class="desig">Email: <a href="mailto:ddduong@agu.edu.vn">ddduong@agu.edu.vn</a></span>
          <span class="desig"><a href="{{ env('APP_URL') }}assets/frontend/pdf/ly-lich-khoa-hoc/dam-duc-duong.pdf" class="ly-lich-khoa-hoc">Lý lịch khoa học</a></span>
        </div>
      </li>
      <li class="col-xs-6 col-sm-4 grid-item">
        <div class="quotblock"><img src="{{ env('APP_URL') }}assets/frontend/images/nhansu/qthong.jpg" class="img-responsive" title="Quách Thị Hồng">
          <h3>Ths. QUÁCH THỊ HỒNG</h3>
          <span class="desig">Chức vụ: Nghiên cứu viên</span>
          <span class="desig">Di động: <a href="tel:0918 607 123">0918 607 123</a></span>
          <span class="desig">Email: <a href="mailto:qthong@agu.edu.vn">qthong@agu.edu.vn</a></span>
          <span class="desig"><a href="{{ env('APP_URL') }}assets/frontend/pdf/ly-lich-khoa-hoc/quach-thi-hong.pdf" class="ly-lich-khoa-hoc">Lý lịch khoa học</a></span>
        </div>
      </li>
      <li class="col-xs-6 col-sm-4 grid-item">
        <div class="quotblock"><img src="{{ env('APP_URL') }}assets/frontend/images/nhansu/mtvan.jpg" class="img-responsive" title="Mai Thị Vân">
          <h3>Ths. MAI THỊ VÂN</h3>
          <span class="desig">Chức vụ: Nghiên cứu viên</span>
          <span class="desig">Di động: <a href="tel:0988 975 788">0988 975 788</a></span>
          <span class="desig">Email: <a href="mailto:mtvan@agu.edu.vn">mtvan@agu.edu.vn</a></span>
          <span class="desig"><a href="{{ env('APP_URL') }}assets/frontend/pdf/ly-lich-khoa-hoc/mai-thi-van.pdf" class="ly-lich-khoa-hoc">Lý lịch khoa học</a></span>
        </div>
      </li>
      <li class="col-xs-6 col-sm-4 grid-item">
        <div class="quotblock"><img src="{{ env('APP_URL') }}assets/frontend/images/nhansu/lxgioi.jpg" class="img-responsive" title="Lê Xuân Giới">
          <h3>CN. LÊ XUÂN GIỚI</h3>
          <span class="desig">Chức vụ: Nghiên cứu viên</span>
          <span class="desig">Di động: <a href="tel:0989 584 858">0989 584 858</a></span>
          <span class="desig">Email: <a href="mailto:lxgioi@agu.edu.vn">lxgioi@agu.edu.vn</a></span>
          <span class="desig"><a href="#" class="ly-lich-khoa-hoc"></a></span>
        </div>
      </li>
      <li class="col-xs-6 col-sm-4 grid-item">
        <div class="quotblock"><img src="{{ env('APP_URL') }}assets/frontend/images/nhansu/lthhanh.jpg" class="img-responsive" title="Lê Thị Hồng Hạnh">
          <h3>Ths. LÊ THỊ HỒNG HẠNH</h3>
          <span class="desig">Chức vụ: Nghiên cứu viên</span>
          <span class="desig">Di động: <a href="tel:0974 828 916">0974 828 916</a></span>
          <span class="desig">Email: <a href="mailto:lthhanh@agu.edu.vn">lthhanh@agu.edu.vn</a></span>
          <span class="desig"><a href="{{ env('APP_URL') }}assets/frontend/pdf/ly-lich-khoa-hoc/le-thi-hong-hanh.pdf" class="ly-lich-khoa-hoc">Lý lịch khoa học</a></span>
        </div>
      </li>
      <li class="col-xs-6 col-sm-4 grid-item">
        <div class="quotblock"><img src="{{ env('APP_URL') }}assets/frontend/images/nhansu/ntnha.jpg" class="img-responsive" title="Nguyễn Thái Ngọc Hà">
          <h3>Ths. NGUYỄN THÁI NGỌC HÀ</h3>
          <span class="desig">Chức vụ: Nghiên cứu viên</span>
          <span class="desig">Di động: <a href="tel:0973 023 705">0973 023 705</a></span>
          <span class="desig">Email: <a href="mailto:ntnha@agu.edu.vn">ntnha@agu.edu.vn</a></span>
          <span class="desig"><a href="{{ env('APP_URL') }}assets/frontend/pdf/ly-lich-khoa-hoc/nguyen-thai-ngoc-ha.pdf" class="ly-lich-khoa-hoc">Lý lịch khoa học</a></span>
        </div>
      </li>
    </ul>
    <br />
    <h3>Kế toán</h3>
    <hr />
    <ul class="row testimonials" style="position: relative; height: 3876px;">
      <li class="col-xs-6 col-sm-4 grid-item">
        <div class="quotblock"><img src="{{ env('APP_URL') }}assets/frontend/images/nhansu/dttam.jpg" class="img-responsive" title="Đinh Thị Tâm">
          <h3>CN. ĐINH THỊ TÂM</h3>
          <span class="desig">Chức vụ: Kế toán</span>
          <span class="desig">Email: <a href="mailto:dinhthitam@agu.edu.vn">dinhthitam@agu.edu.vn</a></span>
        </div>
      </li>
    </ul> --}}
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
