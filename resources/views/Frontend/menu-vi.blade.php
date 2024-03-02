@php
  $path = App\Http\Controllers\TranslatePathController::getPath(Request::path());
  $locale = app()->getLocale();
  if($path) {
      if($locale == 'vi'){
          $path_vi = env('APP_URL') . Request::path();
          $path_en = env('APP_URL') . $path;
      } else {
          $path_en = env('APP_URL') . Request::path();
          $path_vi = env('APP_URL') . $path;
      }
  } else {
      $path_vi = env('APP_URL') . 'vi';
      $path_en = env('APP_URL') . 'en';
  }
@endphp
<header>
  <div class="header-top">
    <div class="container clearfix">
      <div class="right-block clearfix">
        <ul class="top-nav" style="margin-left:0px;">
          <li><a href="#" onclick="return false;" class="search"><i class="fa fa-search"></i></a></li>
          @if(app()->getLocale() == 'vi')
            <li><a href="{{ $path_en }}" title="{{ __('English') }}">{{ __('EN') }}</a></li>
          @endif
          @if(app()->getLocale() == 'en')
            <li><a href="{{ $path_vi }}" title="{{ __('Tiếng Việt') }}">{{ __('VI') }}</a></li>
          @endif
        </ul>
      </div>
    </div>
  </div>
  <!-- Start Header Middle -->
  <div class="container header-middle">
    <div class="row">
      <span class="col-xs-7 col-md-4 col-sm-8">
        <a href="{{ env('APP_URL') }}">
          <img src="{{ env('APP_URL') }}assets/frontend/images/logo_{{ app()->getLocale() }}.png" class="" alt="{{ __('Trung tâm Nghiên cứu Xã hội và Nhân văn Trường Đại học An Giang') }}" title="{{ __('Trung tâm Nghiên cứu Xã hội và Nhân văn Trường Đại học An Giang') }}" style="width:120%;">
        </a>
      </span>
      <div class="col-xs-5 col-md-8 col-sm-7" id="SearchForm">
        <div class="contact clearfix">
          <form action="{{ env('APP_URL').app()->getLocale() }}/tim-kiem" method="GET" class="navbar-form navbar-right">
            <input type="text" name="q" id="q" value="{{ isset($q) ? $q : '' }}" placeholder="{{ __('Tìm kiếm') }}" class="form-control" required>
            <button class="search-btn"><span class="icon-search-icon"></span></button>
          </form>
          {{-- <ul>
            <li class="hidden-xs"><span>Email</span> <a href="mailto:shrc@agu.edu.vn">shrc@agu.edu.vn</a> </li>
            <li><span class="hidden-xs">Hotline</span><a href="tel:02963943695">02963.943.695</a></li>
          </ul> --}}
          </div>
      </div>
    </div>
  </div>
  <!-- End Header Middle -->
  <!-- Start Navigation -->
  <nav class="navbar navbar-inverse" style="background:#008f3b;">
    <div class="container">
      <div class="navbar-header">
        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="navbar-collapse collapse" id="navbar">
        {{-- <form class="navbar-form navbar-right">
          <input type="text" placeholder="Tìm kiếm" class="form-control">
          <button class="search-btn"><span class="icon-search-icon"></span></button>
        </form> --}}
        <ul class="nav navbar-nav">
          <li class="dropdown"><a data-toggle="dropdown"  href="#" >Giới thiệu <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li><a href="{{ env('APP_URL') }}vi/tong-quan" style="font-weight:bold;">Tổng quan</a></li> 
              <!-- <li class="dropdown"><a data-toggle="dropdown" href="#">Cơ cấu tổ chức</a>     -->
              <li><a href="{{ env('APP_URL') }}vi/nhan-su/ban-lanh-dao-khoa">Ban Lãnh đạo khoa</a></li>
              <li><a href="{{ env('APP_URL') }}vi/nhan-su/van-phong-khoa">Văn phòng khoa</a></li>
              <li><a href="{{ env('APP_URL') }}vi/nhan-su/bo-mon-cong-nghe-thuc-pham">Bộ môn Công nghệ Thực phẩm</a></li>
              <li><a href="{{ env('APP_URL') }}vi/nhan-su/bo-mon-nuoi-trong-thuy-san">Bộ môn Nuôi trồng Thủy sản</a></li>
              <li><a href="{{ env('APP_URL') }}vi/nhan-su/bo-mon-cong-nghe-sinh-hoc">Bộ môn Công nghệ Sinh học</a></li>
              <li><a href="{{ env('APP_URL') }}vi/nhan-su/bo-mon-chan-nuoi-thu-y">Bộ môn Chăn nuôi thú y</a></li>
              <li><a href="{{ env('APP_URL') }}vi/nhan-su/bo-mon-khoa-hoc-cay-trong">Bộ môn Khoa học Cây trồng</a></li>
              <li><a href="{{ env('APP_URL') }}vi/nhan-su/bo-mon-phat-trien-nong-thon-va-qltntn">Bộ môn Phát triển Nông thôn và QLTNTN</a></li>
              
            </ul>
          </li>
          <li class="dropdown"><a data-toggle="dropdown" href="{{ env('APP_URL') }}vi/tin-tuc-su-kien">Tin tức <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              @foreach($tags as $ktag => $tag)
              <li><a href="{{ env('APP_URL') }}vi/tin-tuc-su-kien/tag/{{ $ktag }}">{{ $tag }}</a></li>
              @endforeach
              <li><a href="{{ env('APP_URL') }}vi/hinh-anh-hoat-dong">Hình ảnh hoạt động</a></li>
            </ul>
          </li>
          
          <li class="dropdown"><a data-toggle="dropdown"  href="#">Đào tạo <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">   
              <li class="dropdown"><a data-toggle="dropdown" href="#">Đại học</a>
                <ul>
                    <li><a href="{{ env('APP_URL') }}vi/nganh-dao-tao/cong-nghe-thuc-pham">Công nghệ thực phẩm</a></li>
                    <li><a href="#">Đảm bảo chất lượng & ATVSTP</a></li>
                    <li><a href="#">Nuôi trồng Thuỷ sản</a></li>
                    <li><a href="#">Công nghệ Sinh học</a></li>
                    <li><a href="#">Chăn nuôi</a></li>
                    <li><a href="#">Thú y</a></li>
                    <li><a href="#">Khoa học Cây trồng</a></li>
                    <li><a href="#">Bảo vệ Thực vật</a></li>
                    <li><a href="#">Phát triển Nông thôn & QLTNTN</a></li>
                </ul>
              </li>
              <li class="dropend"><a href="#">Thạc sỹ</a>
                <ul >
                  <li><a href="#">Chăn nuôi</a></li>
                  <li><a href="#">Khoa học Cây trồng</a></li>
                  <li><a href="#">Công nghệ Thực phẩm</a></li>
                  <li><a href="#">Công nghệ Sinh học</a></li>
                </ul>
              </li>
            </ul>
          </li> 
          <li class="dropdown"><a data-toggle="dropdown"  href="#">Nghiên cứu khoa học <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li class="dropdown"><a data-toggle="dropdown" href="#">Giảng viên</a>
                <ul>
                    <li><a href="{{ env('APP_URL') }}vi/du-an">Đề tài cấp Cơ sở</a></li>
                    <li><a href="#">Đề tài cấp Trường</a></li>
                    <li><a href="#">Đề tài cấp ĐHQG</a></li>
                    <li><a href="#">Đề tài cấp Tỉnh </a></li>   
                </ul>
              </li>
              <li class="dropdown"><a data-toggle="dropdown" href="#">Sinh viên</a>
                <ul>
                    <li><a href="#">Khóa luận tốt nghiệp</a></li>
                    <li><a href="#">Thực tập cuối khóa </a></li>   
                </ul>
              </li>
              <!--   -->
            </ul> 
          </li>                                                                 
          
          <!-- <li class="dropdown"><a data-toggle="dropdown" href="#">Nghiên cứu <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li><a  href="{{ env('APP_URL') }}vi/nhiem-vu-khoa-hoc-cong-nghe">Nhiệm vụ KH&CN</a></li>
              <li><a  href="{{ env('APP_URL') }}vi/du-an">Dự án</a></li>
              <li><a  href="{{ env('APP_URL') }}vi/cong-bo-khoa-hoc">Công bố Khoa học</a></li>
              {{-- <li><a href="{{ env('APP_URL') }}vi/hoi-nghi-hoi-thao">Hội nghị - Hội thảo</a></li> --}}
              <li><a  href="{{ env('APP_URL') }}vi/van-ban">Văn bản</a></li>
            </ul>
          </li> -->
          {{-- 
            $dich_vu = App\Models\DichVu::where('locale', '=', app()->getLocale())->get();
          
          
          <li class="dropdown"><a data-toggle="dropdown" href="{{ env('APP_URL') }}vi/dich-vu">Dịch vụ <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            @if($dich_vu)
            <ul class="dropdown-menu">
              @foreach($dich_vu as $dv)
                <li><a href="{{ env('APP_URL') }}vi/dich-vu/{{ $dv['slug'] }}">{{ $dv['ten'] }}</a></li>
              @endforeach
            </ul>
            @endif
          </li> --}}
          {{-- <li><a href="{{ env('APP_URL') }}vi/hinh-anh">Hình ảnh</a></li> --}}
          {{--
          @php
            $dich_vu = App\Models\DichVu::orderBy('order', 'asc')->get();
          @endphp
          @if($dich_vu)
          <li class="dropdown"> <a data-toggle="dropdown" href="#">Dịch vụ <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              @foreach($dich_vu as $dv)
                <li><a href="{{ env('APP_URL') }}dich-vu/{{ $dv['slug'] }}">{{ $dv['title'] }}</a></li>
              @endforeach
            </ul>
          </li>
          @endif --}}
          {{--
          @php
            $arr_thongtin = Config::get('app.arr_thongtin');
          @endphp
          <li class="dropdown"> <a data-toggle="dropdown" href="#">Thông tin <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              @foreach($arr_thongtin as $ktt => $vtt)
                <li><a href="{{ env('APP_URL') }}thong-tin/{{ $ktt }}">{{ $vtt }}</a></li>
              @endforeach
                <li><a href="{{ env('APP_URL') }}tra-cuu-chung-chi">Tra cứu Chứng chỉ</a></li>
                <li><a href="{{ env('APP_URL') }}danh-ba-dien-thoai">Danh bạ điện thoại</a></li>
            </ul>
          </li> --}}
          <li> <a href="#">Hợp tác quốc tế</a></li>
          <li class="dropdown"><a data-toggle="dropdown"  href="#">Văn bản - Biểu mẫu <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li><a href="#">Biểu mẫu dành cho Giảng viên</a></li>
              <li><a href="#"> biểu mẫu dành cho Sinh viên</a></li>
            </ul> 
          </li>
          <li class="dropdown"><a data-toggle="dropdown"  href="#">Đoàn thể<i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
              <li><a href="#">Công tác Đảng</a></li>
              <li><a href="#">Đoàn thanh niên</a></li>
              <li><a href="#">Hội sinh viên</a></li>
              <li><a href="#">Công đoàn</a></li>
            </ul> 
          </li>
          <!-- <li> <a href="{{ env('APP_URL') }}vi/lien-he">Liên hệ</a></li> -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navigation -->
</header>