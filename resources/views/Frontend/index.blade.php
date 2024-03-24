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
      <a href="{{ env('APP_URL') }}vi/dao-tao"> <h3 style="padding-bottom:20px;text-transform:uppercase;color: #058B3C;"><i class="fa fa-newspaper-o"></i> {{ __('Ngành đào tạo') }}</h3></a>
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
        <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/hinh-anh-hoat-dong"><h3 style="padding-bottom:20px;text-transform:uppercase;color: #058B3C;"><i class="fa fa-newspaper-o"></i> {{ __('Hình ảnh hoạt động') }}</h3></a>
      </div>
    </div>     
      @if($danhsach_hinh_anh_hoat_dong)  
        <ul class="row">
          @foreach($danhsach_hinh_anh_hoat_dong as $b)
            @if($b['photos'])
             @foreach($b['photos'] as $p)
              <li class="col-sm-3" style="margin-top: 10px;">
                @if($ds['photos'])
                <a class="galleryItem" href="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}"> 
                  <figure><img style="object-fit: cover;height: 250px;width:300px; margin-left:13px;margin-top: 13px;" src="{{ env('APP_URL') }}storage/images/origin/{{ $p['aliasname'] }}" alt="{{ $b['title'] }}" title="{{ $b['title'] }}"" class="img-responsive" alt=""></figure>
                </a> 
                @endif
             </li>
             @endforeach
            @endif
          @endforeach
        </ul>
      @endif
  </div>
</section>
<!-- End Campus Tour Section -->
{{--
<section class="about inner padding-lg">
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="text-align:justify;">
        <p> Trung tâm Nghiên cứu Khoa học xã hội và Nhân văn được thành lập theo Quyết định số 671/QĐ.UB ngày 07 tháng 05 năm 2003 của Uỷ ban nhân dân tỉnh An Giang.</p>
        <p>Trung tâm là một tổ chức nghiên cứu và phát triển cấp cơ sở, là đơn vị sự nghiệp trực thuộc Trường Đại học An Giang. Trung tâm có đầy đủ tư cách pháp nhân, có con dấu và tài khoản riêng tại Kho bạc nhà nước tỉnh An Giang.</p>
        <ul style="padding-bottom:10px;">
            <li>Trụ sở: số 18, đường Ung Văn Khiêm, phường Đông Xuyên, thành phố Long Xuyên, tỉnh An Giang (Lầu 2, Toà nhà Thư viện và các Trung tâm, khu trung tâm Trường Đại học An Giang)</li>
            <li>Điện thoại: 0296 3943695</li>
            <li>E-mail: shrc@agu.edu.vn</li>
            <li>Website: shrc.agu.edu.vn</li>
        </ul>
        <p>Trung tâm thực hiện các hoạt động nghiên cứu, ứng dụng và chuyển giao, đào tạo và huấn luyện và các dịch vụ khoa học và công nghệ lĩnh vực khoa học xã hội nhân văn nhằm đáp ứng yêu cầu phát triển nhà trường, phát triển kinh tế - xã hội tỉnh An Giang, các tỉnh Đồng bằng sông Cửu Long và nhu cầu xã hội. Trung tâm nỗ lực phấn đấu trở thành một trong những trung tâm nghiên cứu hàng đầu của tỉnh và khu vực.</p>
        <p class="text-center">
            <a class="galleryItem" href="{{ env('APP_URL') }}assets/frontend/images/shrc.jpg">
          <img src="{{ env('APP_URL') }}assets/frontend/images/shrc.jpg" alt="Trung tâm Nghiên cứu Xã hội và Nhân văn" style="margin: 0px 20px 0px 0px; "></a>
        </p>
        <p>Trung tâm đã tổ chức thực hiện các hoạt động KHCN đáp ứng yêu cầu phát triển của các cơ quan, đơn vị, tổ chức trong và ngoài tỉnh như: các dự án xây dựng và triển khai các mô hình hỗ trợ cộng đồng (Tăng cường tiếng Việt cho trẻ em dân tộc Khmer trong phum sóc với sự hỗ trợ của sinh viên dân tộc Khmer; Nâng cao năng lực các dịch vụ tâm lý xã hội cho trẻ em mồ côi bị nhiễm HIV/AIDS và trẻ em bị ảnh hưởng bởi HIV/AIDS thông qua các dịch vụ trực tiếp và đào tạo công tác xã hội; Tăng cường hiểu biết về chính sách ưu đãi cho học sinh thiệt thòi nhằm đẩy lùi tham nhũng trong giáo dục...); các nghiên cứu cơ bản hỗ trợ các ngành, các cấp, các cơ quan, tổ chức xây dựng và triển khai các chính sách, chương trình, kế hoạch phát triển (thực trạng và giải pháp khắc phục tình trạng bỏ học của học sinh, thực trạng và giải pháp nâng cao chất lượng của đội ngũ giáo viên tiểu học; thực trạng và giải pháp tiếp cận giáo dục của người Chăm; nhu cầu giáo viên phổ thông và giáo viên dạy nghề; thực trạng và giải pháp thực hiện sự tiến bộ của phụ nữ; các yếu tố ảnh hưởng đến sự tham gia nghiên cứu khoa học của phụ nữ...); các hội thảo khoa học trong nước và quốc tế (công tác xã hội và sức khỏe cộng đồng, giảm nghèo bền vững, chất lượng giáo dục phổ thông,  bảo vệ, chăm sóc và giáo dục trẻ em, biến đổi chức năng gia đình trong thời kỳ công nghiệp hóa, hiện đại hóa...). </p>
      </div>
    </div>
  </div>
</section> --}}
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