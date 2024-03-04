@extends('Frontend.layout')
@section('title', __('Khóa luận tốt nghiệp'))
@section('css')
    <style type="text/css" media="screen">
        .card-box {
            background: #fff;
            margin-bottom: 5px;
            padding: 20px;
            border-radius: 10px;
        }
        .card-box h5 {
            text-transform: none;
            font-weight: normal;
            line-height: 30px;
            font-size: 18px;
        }
        .card-box h5:hover {
            color: #2a92d0;
        }
    </style>
@endsection
@section('body')
{{-- @include('Frontend.widget_banner') --}}
<section class="news-wrapper padding-xs">
    <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <h3 style="padding-bottom:20px;"><i class="fa fa-envira"></i> {{ __('Khóa luận tốt nghiệp') }}</h3>
            <div class="card-box">                         
                <div class="row">
                    <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead> 
                            <tr>
                                <th width="45%">{{ __('Tên đề tài') }}:</th>
                                <th width="45%">{{ __('Tên sinh viên') }}:</th>
                                <th width="10%"> {{ __('Năm') }}:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($danhsach as $ds)
                            <tr>
                                <th><a href="#">{{ $ds['ten_de_tai']}}</a></th>
                                <th>{{ $ds['ten_sinh_vien']}}</th>
                                <th>{{ $ds['nam']}}</th>
                            </tr>@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
          </div>
        </div>
        <br />
        {{ $danhsach->withPath(env('APP_URL').app()->getLocale().'/khoa-luan-tot-nghiep') }}
    </div>
</section>
@endsection
@section('js')
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
