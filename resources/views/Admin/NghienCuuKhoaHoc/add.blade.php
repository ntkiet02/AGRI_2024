@extends('Admin.layout')
@section('title', __('Thêm Nghiên cứu Khoa học'))
@section('css')
<link href="{{ env('APP_URL') }}assets/backend/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="row">
  <div class="col-12">
        <div class="card-box">
            <h3 class="m-t-0"><a href="{{ env('APP_URL').app()->getLocale() }}/admin/nghien-cuu-khoa-hoc" class="btn btn-primary btn-sm"><i class="mdi mdi-reply-all"></i> {{ __('Trở về') }}</a> {{ __('Thêm mới Nghiên cứu Khoa học') }}</h3>
            <form action="{{ env('APP_URL').app()->getLocale() }}/admin/nghien-cuu-khoa-hoc/create" method="post" id="dinhkemform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="trans_id" id="trans_id" value="{{ $trans_id }}" placeholder="">
                <input type="hidden" name="trans_lang" id="trans_lang" value="{{ $trans_lang }}" placeholder="">
                <div class="form-body">
                    <hr />
                    @if($errors->any())
                        <div class="alert alert-success">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @php
                        if(old('ma_so_nhiem_vu') != null) {
                            $ma_so_nhiem_vu = old('ma_so_nhiem_vu');
                            $so_dang_ky_ket_qua = old('so_dang_ky_ket_qua');
                            $ten_nhiem_vu = old('ten_nhiem_vu');
                            $to_chuc_chu_tri = old('to_chuc_chu_tri');
                            $co_quan_chu_quan = old('co_quan_chu_quan');
                            $cap_quan_ly = old('cap_quan_ly');
                            $chu_nhiem_nhiem_vu = old('chu_nhiem_nhiem_vu');
                            $cac_thanh_vien_tham_gia = old('cac_thanh_vien_tham_gia');
                            $linh_vuc_nghien_cuu = old('linh_vuc_nghien_cuu');
                            $thoi_gian_thuc_hien = old('thoi_gian_thuc_hien');
                            //$so_trang = old('so_trang');
                            $tom_tat = old('tom_tat');
                            $tu_khoa = old('tu_khoa');
                        } else if(isset($ds['ma_so_nhiem_vu']) && $ds['ma_so_nhiem_vu']) {
                            $ma_so_nhiem_vu = $ds['ma_so_nhiem_vu'];
                            $so_dang_ky_ket_qua = $ds['so_dang_ky_ket_qua'];
                            $ten_nhiem_vu = $ds['ten_nhiem_vu'];
                            $to_chuc_chu_tri = $ds['to_chuc_chu_tri'];
                            $co_quan_chu_quan = $ds['co_quan_chu_quan'];
                            $cap_quan_ly = $ds['cap_quan_ly'];
                            $chu_nhiem_nhiem_vu = $ds['chu_nhiem_nhiem_vu'];
                            $cac_thanh_vien_tham_gia = $ds['cac_thanh_vien_tham_gia'];
                            $linh_vuc_nghien_cuu = $ds['linh_vuc_nghien_cuu'];
                            $thoi_gian_thuc_hien = $ds['thoi_gian_thuc_hien'];
                            //$so_trang = $ds['so_trang'];
                            $tom_tat = $ds['tom_tat'];
                            $tu_khoa = $ds['tu_khoa'];
                        } else {
                            $ma_so_nhiem_vu = '';$so_dang_ky_ket_qua= '';$ten_nhiem_vu= '';$to_chuc_chu_tri= '';$co_quan_chu_quan= '';$cap_quan_ly= '';$chu_nhiem_nhiem_vu= '';$cac_thanh_vien_tham_gia= '';$linh_vuc_nghien_cuu= '';$thoi_gian_thuc_hien= '';$tom_tat= '';$tu_khoa= '';
                        }
                    @endphp
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Mã số nhiệm vụ') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="ma_so_nhiem_vu" name="ma_so_nhiem_vu" class="form-control" placeholder="{{ __('Mã số nhiệm vụ') }}" value="{{ $ma_so_nhiem_vu }}" />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Số đăng ký kết quả') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="so_dang_ky_ket_qua" name="so_dang_ky_ket_qua" class="form-control" placeholder="Số đăng ký kết quả" value="{{ $so_dang_ky_ket_qua }}"  />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Tên nhiệm vụ') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="ten_nhiem_vu" name="ten_nhiem_vu" class="form-control" placeholder="{{ __('Tên nhiệm vụ') }}" value="{{ $ten_nhiem_vu }}"  />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Thời gian thực hiện') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="thoi_gian_thuc_hien" name="thoi_gian_thuc_hien" class="form-control" placeholder="Thời gian thực hiện" value="{{ $thoi_gian_thuc_hien }}" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Cơ quan chủ trì') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="to_chuc_chu_tri" name="to_chuc_chu_tri" class="form-control" placeholder="{{ __('Tổ chức chủ trì') }}" value="{{ $to_chuc_chu_tri }}" />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Cơ quan chủ quản') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="co_quan_chu_quan" name="co_quan_chu_quan" class="form-control" placeholder="{{ __('Cơ quan chủ quản') }}" value="{{ $co_quan_chu_quan }}" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Cấp quản lý') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="cap_quan_ly" name="cap_quan_ly" class="form-control" placeholder="{{ __('Cấp quản lý') }}" value="{{ $cap_quan_ly }}"  />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Chủ nhiệm nhiệm vụ') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="chu_nhiem_nhiem_vu" name="chu_nhiem_nhiem_vu" class="form-control" placeholder="{{ __('Chủ nhiệm nhiệm vụ') }}" value="{{ $chu_nhiem_nhiem_vu }}" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Các thành viên tham gia') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="cac_thanh_vien_tham_gia" name="cac_thanh_vien_tham_gia" class="form-control" placeholder="{{ __('Các thành viên tham gia') }}" value="{{ $cac_thanh_vien_tham_gia }}" />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Lĩnh vực nghiên cứu') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="linh_vuc_nghien_cuu" name="linh_vuc_nghien_cuu" class="form-control" placeholder="{{ __('Lĩnh vực nghiên cứu') }}" value="{{ $linh_vuc_nghien_cuu }}" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Tóm tắt') }}</label>
                        <div class="col-md-10">
                            <textarea name="tom_tat" id="tom_tat" style="height:80px;" class="form-control" placeholder="Nội dung">{{ $tom_tat }}</textarea>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Từ khóa') }}</label>
                        <div class="col-md-10">
                            <input type="text" id="tu_khoa" name="tu_khoa" class="form-control" placeholder="{{ __('Từ khóa') }}" value="{{ $tu_khoa }}" />
                        </div>
                    </div>
               </div>
                <div class="form-actions">
                    <a href="{{ env('APP_URL').app()->getLocale() }}/admin/nghien-cuu-khoa-hoc" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ env('APP_URL') }}assets/backend/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            jQuery("#thoi_gian_bat_dau").datepicker({ format:"dd/mm/yyyy", autoclose: true});
            jQuery("#thoi_gian_ket_thuc").datepicker({ format:"dd/mm/yyyy", autoclose: true });
            var options = {
                filebrowserImageBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Files',
                filebrowserUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Files&_token='
            };
            CKEDITOR.replace('tom_tat', options);
        });
    </script>
@endsection
