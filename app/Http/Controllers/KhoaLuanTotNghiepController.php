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
use App\Models\KhoaLuanTotNghiep;
use App\Models\TranslatePath;

class KhoaLuanTotNghiepController extends Controller
{
    //
    function list(Request $request, $locale = '') {
        $danhsach = KhoaLuanTotNghiep::where('locale','=',$locale)->get();
        return view('Admin.KhoaLuanTotNghiep.list')->with(compact('danhsach'));
    }

    function add(Request $request, $locale=''){
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        if($trans_id){
            $ds = KhoaLuanTotNghiep::find($trans_id);
        } else {
            $ds = '';
        }
        return view('Admin.KhoaLuanTotNghiep.add')->with(compact('ds','trans_id', 'trans_lang'));
    }  

    function create(Request $request, $locale = '') {
        $data = $request->all();
        $validator = Validator::make($data, [
            'ma_so_sinh_vien' => 'required|unique:khoa_luan_tot_nghiep'
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/khoa_luan_tot_nghiep/add')->withErrors($validator)->withInput();
        }
        $db = new KhoaLuanTotNghiep();
        $id = ObjectController::Id();
        $db->_id = $id;
        $db->ten_khoa_luan = $data['ten_khoa_luan'];
        $db->ten_sinh_vien = $data['ten_sinh_vien'];
        $db->ma_so_sinh_vien = $data['ma_so_sinh_vien'];
        $db->lop=$data['lop'];
        $db->giang_vien_huong_dan = $data['giang_vien_huong_dan'];
        $db->nam = $data['nam'];
        $db->thoi_gian_thuc_hien = $data['thoi_gian_thuc_hien'];
        //$db->so_trang = $data['so_trang'];

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
                $trans->collection = 'khoa_luan_tot_nghiep';
                $trans->save();
            }
        } else {
            $trans = new TranslatePath();
            $trans->{"id_$locale"} = $id;
            $trans->{"slug_$locale"} = $id;
            $trans->collection = 'khoa_luan_tot_nghiep';
            $trans->save();
        }

        Session::flash('msg', 'Cập nhật thành công');
        return redirect(env('APP_URL').$locale.'/admin/khoa-luan-tot-nghiep');
    }

    function edit(Request $request, $locale = '', $id = '') {
        $trans_id = $request->input('trans_id');
        $trans_lang = $request->input('trans_lang');
        $ds = KhoaLuanTotNghiep::find($id);
        return view('Admin.KhoaLuanTotNghiep.edit')->with(compact('ds','trans_id', 'trans_lang'));
    }

    function update(Request $request, $locale = '', $id='') {
        $data = $request->all();
        $validator = Validator::make($data, [
            'ma_so_sinh_vien' => 'required:unique:khoa_luan_tot_nghiep,_id,'.$data['id']
        ]);
        if ($validator->fails()) {
          return redirect(env('APP_URL').$locale.'/admin/khoa-luan-tot-nghiep/edit/'.$data['id'].'?trans_id='.$data['trans_id'].'&trans_lang='.$data['trans_lang'])->withErrors($validator)->withInput();
        }
        $id_user = $request->session()->get('user._id');
        $db = KhoaLuanTotNghiep::find($data['id']);
        $db->ten_khoa_luan = $data['ten_khoa_luan'];
        $db->ten_sinh_vien = $data['ten_sinh_vien'];
        $db->ma_so_sinh_vien = $data['ma_so_sinh_vien'];
        $db->lop=$data['lop'];
        $db->giang_vien_huong_dan = $data['giang_vien_huong_dan'];
        $db->nam = $data['nam'];
        $db->thoi_gian_thuc_hien = $data['thoi_gian_thuc_hien'];
        //$db->so_trang = $data['so_trang'];
        $db->locale = $locale;
        $db->id_user = ObjectController::ObjectId($id_user);
        $db->save();

        //update translatepath
        $trans_lang = $data['trans_lang'];
        $trans_id = $data['trans_id'];
        $id_path = ObjectController::ObjectId($data['id']);
        $check_path = TranslatePath::where("id_".$locale, "=", $id_path)->first();
        $trans = TranslatePath::find($check_path['_id']);
        $trans->{"id_$locale"} = $id_path;
        $trans->{"slug_$locale"} = ObjectController::ObjectId($data['id']);
        $trans->collection = 'khoa_luan_tot_nghiep';
        $trans->save();
        Session::flash('msg', 'Cập nhật thành công');
        if($trans_lang) return redirect(env('APP_URL') .$trans_lang.'/admin/khoa-luan-tot-nghiep');
        return redirect(env('APP_URL') .$locale.'/admin/khoa-luan-tot-nghiep');
    }

    function delete(Request $request, $locale='', $id = '') {
        KhoaLuanTotNghiep::destroy($id);
        $id_path = ObjectController::ObjectId($id);
        $trans = TranslatePath::where('id_'.$locale, '=', $id_path)->first();
        if($trans){
            $trans->unset('id_'.$locale);
            $trans->unset('slug_'.$locale);
        }
        Session::flash('msg', 'Cập nhật thành công');
        return redirect(env('APP_URL').$locale.'/admin/khoa-luan-tot-nghiep');
    }
}
