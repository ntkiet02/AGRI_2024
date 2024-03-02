@extends('Admin.layout')
@section('title', __('Sửa Nhân sự'))
@section('css')
    <link href="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/magnific-popup.css"/>
@endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h3 class="m-t-0"><a href="{{ env('APP_URl') }}{{ app()->getLocale() }}/admin/nhan-su/{{ $tags }}" class="btn btn-primary btn-sm"><i class="mdi mdi-reply-all"></i> {{ __('Trở về') }}</a> {{ __('Thêm mới') }} @if($tags == 'nhan-su') {{ __('Nhân sự') }} @else {{ __('Chuyên gia') }} @endif</h3>
            <form action="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/{{ $tags }}/update" method="post" id="dinhkemform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{{ $ds['_id'] }}" placeholder="">
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
                        if(old('ho_ten') != null){
                            $ho_ten = old('ten');
                            $chuc_vu = old('chuc_vu');
                            $dien_thoai = old('dien_thoai');
                            $email = old('email');
                            $mo_ta = old('mo_ta');$thu_tu = old('thu_tu');
                        } else if(isset($ds['ho_ten']) && $ds['ho_ten']){
                            $ho_ten = $ds['ho_ten'];
                            $chuc_vu = $ds['chuc_vu'];
                            $dien_thoai = $ds['dien_thoai'];
                            $email = $ds['email'];
                            $mo_ta = $ds['mo_ta']; $thu_tu = $ds['thu_tu'];
                        } else {
                            $ho_ten='';$chuc_vu='';$dien_thoai='';$email='';$mo_ta='';$thu_tu =0;
                        }
                    @endphp
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Họ tên') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="ho_ten" name="ho_ten" class="form-control" placeholder="{{ __('Họ tên') }}" value="{{ $ho_ten }}" required />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Chức vụ') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="chuc_vu" name="chuc_vu" class="form-control" placeholder="{{ __('Chức vụ') }}" value="{{ $chuc_vu }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Điện thoại') }}</label>
                        <div class="col-md-4">
                            <input type="text" id="dien_thoai" name="dien_thoai" class="form-control" placeholder="{{ __('Điện thoại') }}" value="{{ $dien_thoai }}" />
                        </div>
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Email') }}</label>
                        <div class="col-md-4">
                            <input type="email" id="email" name="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ $email }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Thứ tự') }}</label>
                        <div class="col-md-4">
                            <input type="number" id="thu_tu" name="thu_tu" class="form-control" placeholder="{{ __('Thứ tự') }}" value="{{ $thu_tu }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2 text-right p-t-10">{{ __('Mô tả') }}</label>
                        <div class="col-12 col-md-10">
                            <textarea name="mo_ta" id="mo_ta" class="form-control" required placeholder="{{ __('Mô tả nội dung') }}" style="height:100px;">{{ $mo_ta }}</textarea>
                        </div>
                    </div>
                    <div class="card-box bg-light">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="btn btn-danger">
                                            <input type="file" name="hinhanh_files[]" class="hinhanh_files btn btn-primary" multiple accept="image/png, image/jpeg, image/jpg, image/gif" placeholder="Chọn hình ảnh" style="display:none;" />
                                            <i class="fa fa-images"></i> {{ __('Chọn Hình ảnh') }} : (jpg, png, bmp)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="list_hinhanh">
                            @if(old('hinhanh_aliasname'))
                                @foreach(old('hinhanh_aliasname') as $k => $h)
                                    <div class="col-sm-6 col-md-4 items draggable-element text-center">
                                        <input type="hidden" name="hinhanh_aliasname[]" value="{{ old('hinhanh_aliasname')[$k] }}" readonly/>
                                        <input type="hidden" name="hinhanh_filename[]" class="form-control" value="{{ old('hinhanh_filename')[$k] }}" />
                                        <a href="{{  env('APP_URL') }}storage/images/origin/{{ old('hinhanh_aliasname')[$k] }}" class="image-popup">
                                        <div class="portfolio-masonry-box">
                                          <div class="portfolio-masonry-img">
                                            <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ old('hinhanh_aliasname')[$k] }}" class="thumb-img img-fluid" alt="work-thumbnail">
                                          </div>
                                          <div class="portfolio-masonry-detail">
                                            <p>{{ old('hinhanh_filename')[$k] }}</p>
                                          </div>
                                        </div>
                                        </a>
                                        <a href="{{ env('APP_URL')}}{{ app()->getLocale() }}/image/delete/{{ old('hinhanh_aliasname')[$k] }}" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:40px;right:30px;">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <input type="text" name="hinhanh_title[]" class="form-control" value="{{ old('hinhanh_title')[$k] }}" />
                                    </div>
                                @endforeach
                            @elseif(isset($ds['photos']) && $ds['photos'])
                                @foreach($ds['photos'] as $photo)
                                    <div class="col-sm-6 col-md-4 items draggable-element text-center">
                                        <input type="hidden" name="hinhanh_aliasname[]" value="{{ $photo['aliasname'] }}" readonly/>
                                        <input type="hidden" name="hinhanh_filename[]" class="form-control" value="{{ $photo['filename'] }}" />
                                        <a href="{{  env('APP_URL') }}storage/images/origin/{{ $photo['aliasname'] }}" class="image-popup">
                                        <div class="portfolio-masonry-box">
                                          <div class="portfolio-masonry-img">
                                            <img src="{{ env('APP_URL') }}storage/images/thumb_360x200/{{ $photo['aliasname'] }}" class="thumb-img img-fluid" alt="work-thumbnail">
                                          </div>
                                          <div class="portfolio-masonry-detail">
                                            <p>{{ $photo['filename'] }}</p>
                                          </div>
                                        </div>
                                        </a>
                                        <a href="{{ env('APP_URL')}}{{ app()->getLocale() }}/image/delete/{{ $photo['aliasname'] }}" onclick="return false;" class="btn btn-danger btn-sm delete_file" style="position:absolute;top:40px;right:30px;">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <input type="text" name="hinhanh_title[]" class="form-control" value="{{ $photo['title'] }}" />
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="progress m-b-20" id="progressbar">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ env('APP_URL') }}{{ app()->getLocale() }}/admin/nhan-su/{{ $tags }}" class="btn btn-light"><i class="fa fa-reply-all"></i> {{ __('Trở về') }}</a>
                    <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> {{ __('Cập nhật') }}</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ env('APP_URL') }}assets/backend/libs/select2/select2.min.js" type="text/javascript"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/js/drag-arrange.min.js" type="text/javascript"></script>
    <script src="{{ env('APP_URL') }}assets/backend/libs/ckeditor/ckeditor.js"></script>
    <script src="{{ env('APP_URL') }}assets/backend/js/script.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            delete_file();$(".select2").select2();
            var options = {
                filebrowserImageBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '{{ env('APP_URL') }}laravel-filemanager?type=Files',
                filebrowserUploadUrl: '{{ env('APP_URL') }}laravel-filemanager/upload?type=Files&_token='
            };
            upload_hinhanh("{{ env('APP_URL') }}{{ app()->getLocale() }}/image/uploads");
            $("#progressbar").hide();
            CKEDITOR.replace('mo_ta', options);
        });
    </script>
@endsection
