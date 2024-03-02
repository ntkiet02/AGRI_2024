<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TranslatePathController;
use App\Models\NghienCuuKhoaHoc;
use App\Models\TranslatePath;

class NghienCuuKhoaHocController extends Controller
{
    //
    function list(Request $request, $locale = '') {
        $danhsach = NghienCuuKhoaHoc::where('locale','=',$locale)->get();
        return view('Admin.NghienCuuKhoaHoc.list')->with(compact('danhsach'));
    }

    function add(Request $request, $locale=''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = NghienCuuKhoaHoc::find($trans_id);
        } else {
            $ds = '';
        }
        return view('Admin.NghienCuuKhoaHoc.add')->with(compact('ds','trans_id', 'trans_lang'));
    }

    function create(Request $request, $locale = '') {
        $data = $request->all();
        $validator = Validator::make($data, [
            'ten_nhiem_vu' => 'required|unique:nghien_cuu_khoa_hoc'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/nghien-cuu-khoa-hoc/add')->withErrors($validator)->withInput();
        }
        $db = new NghienCuuKhoaHoc();
        $id = ObjectController::Id();
        $db->_id = $id;
        $db->ma_so_nhiem_vu = $data['ma_so_nhiem_vu'];
        $db->so_dang_ky_ket_qua = $data['so_dang_ky_ket_qua'];
        $db->ten_nhiem_vu = $data['ten_nhiem_vu'];
        $db->to_chuc_chu_tri = $data['to_chuc_chu_tri'];
        $db->co_quan_chu_quan = $data['co_quan_chu_quan'];
        $db->cap_quan_ly = $data['cap_quan_ly'];
        $db->chu_nhiem_nhiem_vu = $data['chu_nhiem_nhiem_vu'];
        $db->cac_thanh_vien_tham_gia = $data['cac_thanh_vien_tham_gia'];
        $db->linh_vuc_nghien_cuu = $data['linh_vuc_nghien_cuu'];
        $db->thoi_gian_thuc_hien = $data['thoi_gian_thuc_hien'];
        //$db->so_trang = $data['so_trang'];
        $db->tom_tat = $data['tom_tat'];
        $db->tu_khoa = $data['tu_khoa'];
        $db->locale = $locale;
        $db->slug = $id;
        $db->save();

        //cập nhật translate path
        $trans_lang = $data['trans_lang'];
        $trans_id = $data['trans_id'];
        if($trans_id && $trans_lang){
            $trans_id = ObjectController::ObjectId($trans_id);
            $check_path = TranslatePath::where("id_".$trans_lang, "=", $trans_id)->first();
            if($check_path){
                $trans = TranslatePath::find($check_path['_id']);
                $trans->{"id_$locale"} = $id;
                $trans->{"slug_$locale"} = $id;
                $trans->collection = 'nghien_cuu_khoa_hoc';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $id;
            $trans->collection = 'nghien_cuu_khoa_hoc';
            $trans->save();
        }

        Session::flash('msg', 'Cập nhật thành công');
        return redirect(env('APP_URL').$locale.'/admin/nghien-cuu-khoa-hoc');
    }

    function edit(Request $request, $locale = '', $id = '') {
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = NghienCuuKhoaHoc::find($id);
        return view('Admin.NghienCuuKhoaHoc.edit')->with(compact('ds','trans_id', 'trans_lang'));
    }

    function update(Request $request, $locale = '') {
        $data = $request->all();
        $validator = Validator::make($data, [
            'ten_nhiem_vu' => 'required:unique:nghien_cuu_khoa_hoc,_id,'.$data['id']
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/nghien-cuu-khoa-hoc/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $db = NghienCuuKhoaHoc::find($data['id']);
        $db->ma_so_nhiem_vu = $data['ma_so_nhiem_vu'];
        $db->so_dang_ky_ket_qua = $data['so_dang_ky_ket_qua'];
        $db->ten_nhiem_vu = $data['ten_nhiem_vu'];
        $db->to_chuc_chu_tri = $data['to_chuc_chu_tri'];
        $db->co_quan_chu_quan = $data['co_quan_chu_quan'];
        $db->cap_quan_ly = $data['cap_quan_ly'];
        $db->chu_nhiem_nhiem_vu = $data['chu_nhiem_nhiem_vu'];
        $db->cac_thanh_vien_tham_gia = $data['cac_thanh_vien_tham_gia'];
        $db->linh_vuc_nghien_cuu = $data['linh_vuc_nghien_cuu'];
        $db->thoi_gian_thuc_hien = $data['thoi_gian_thuc_hien'];
        //$db->so_trang = $data['so_trang'];
        $db->tom_tat = $data['tom_tat'];
        $db->tu_khoa = $data['tu_khoa'];
        $db->locale = $locale;
        $db->slug = ObjectController::ObjectId($data['id']);
        $db->save();

        //update translatepath
        $trans_lang = $data['trans_lang'];
        $trans_id = $data['trans_id'];
        $id_path = ObjectController::ObjectId($data['id']);
        $check_path = TranslatePath::where("id_".$locale, "=", $id_path)->first();
        $trans = TranslatePath::find($check_path['_id']);
        $trans->{"id_$locale"} = $id_path;
        $trans->{"slug_$locale"} = ObjectController::ObjectId($data['id']);
        $trans->collection = 'nghien_cuu_khoa_hoc';
        $trans->save();
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/nghien-cuu-khoa-hoc');
        return redirect(env('APP_URL') .$locale.'/admin/nghien-cuu-khoa-hoc');
    }

    function delete(Request $request, $locale='', $id = '') {
        NghienCuuKhoaHoc::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        Session::flash('msg', 'Cập nhật thành công');
        return redirect(env('APP_URL').$locale.'/admin/nghien-cuu-khoa-hoc');
    }
}
