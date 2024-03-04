<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\TinTucSuKien;
use App\Models\NghienCuuKhoaHoc;
use App\Models\VanBan;
use App\Models\HoiNghiHoiThao;
use App\Models\CongBoKhoaHoc;
use App\Models\DuAn;
use App\Models\DichVu;
use App\Models\DoiTac;
use App\Models\HinhAnh;
use App\Models\NhanSu;
use App\Http\Controllers\VanBanController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\ObjectControler;
use App\Models\KhoaLuanTotNghiep;
use App\Models\NganhDaoTao;
use App\Models\BieuMau;
use Illuminate\Support\Facades\Config;
class FrontendController extends Controller
{
    //
    function index(Request $request, $locale = '') {
        $danhsach_tin_tuc_su_kien = TinTucSuKien::where('locale', '=', $locale)->orderBy('date_post', 'desc')->paginate(9);
        $danhsach_nganh_dao_tao = NganhDaoTao::where('locale', '=', $locale)->orderBy('date_post', 'desc')->paginate(6);
        return view('Frontend.index')->with(compact('danhsach_nganh_dao_tao','danhsach_tin_tuc_su_kien'));
    }
    function nhiem_vu_khoa_hoc_cong_nghe(Request $request, $locale = '') {
        $danhsach = NghienCuuKhoaHoc::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(20);
        return view('Frontend.nhiem-vu-khoa-hoc-cong-nghe')->with(compact('danhsach'));
    }
    function nhiem_vu_khoa_hoc_cong_nghe_ct(Request $request, $locale = '', $slug='') {
        $ds = NghienCuuKhoaHoc::where('locale', '=', $locale)->where('slug','=',ObjectController::ObjectId($slug))->first();
        $danhsach = NghienCuuKhoaHoc::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(7);
        return view('Frontend.nhiem-vu-khoa-hoc-cong-nghe-ct')->with(compact('danhsach','ds'));
    }
    function du_an(Request $request, $locale = '') {
        $danhsach = DuAn::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(7);
        return view('Frontend.du-an')->with(compact('danhsach'));
    }
    function khoa_luan_tot_nghiep(Request $request, $locale = '') {
        $danhsach = KhoaLuanTotNghiep::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(7);
        return view('Frontend.khoa-luan-tot-nghiep')->with(compact('danhsach'));
    }
    function du_an_ct(Request $request, $locale = '', $slug='') {
        $ds = DuAn::where('locale', '=', $locale)->where('slug','=',ObjectController::ObjectId($slug))->first();
        $danhsach = DuAn::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(7);
        return view('Frontend.du-an-ct')->with(compact('danhsach','ds'));
    }
    function nganh_dao_tao(Request $request, $locale = '') {
        $danhsach = NganhDaoTao::where('locale', '=', $locale)->orderBy('date_post', 'desc')->paginate(6);
        return view('Frontend.nganh-dao-tao')->with(compact('danhsach'));
    }
    function nganh_dao_tao_ct(Request $request, $locale = '', $slug = '') {
        $ds = NganhDaoTao::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
        $danhsach = NganhDaoTao::where('tags','=',$ds['tags'])->where('locale', '=', $locale)->paginate(7);
        return view('Frontend.nganh-dao-tao-ct')->with(compact('danhsach', 'ds'));
    }
    function nganh_dao_tao_tag(Request $request, $locale = '', $key = 0) {
        $tags = NganhDaoTaoController::get_tags();
        $danhsach = NganhDaoTao::where('locale', '=', $locale)->where('tags','=',$tags[$key])->orderBy('date_post', 'desc')->paginate(9);
        return view('Frontend.nganh-dao-tao')->with(compact('danhsach'));
    }
    function tin_tuc_su_kien(Request $request, $locale = '') {
        $danhsach = TinTucSuKien::where('locale', '=', $locale)->orderBy('date_post', 'desc')->paginate(6);
        return view('Frontend.tin-tuc-su-kien')->with(compact('danhsach'));
    }
    function tin_tuc_su_kien_tag(Request $request, $locale = '', $key = 0) {
        $tags = TinTucSuKienController::get_tags();
        $danhsach = TinTucSuKien::where('locale', '=', $locale)->where('tags','=',$tags[$key])->orderBy('date_post', 'desc')->paginate(9);
        return view('Frontend.tin-tuc-su-kien')->with(compact('danhsach'));
    }
    function tin_tuc_su_kien_ct(Request $request, $locale = '', $slug = '') {
        $ds = TinTucSuKien::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
        $danhsach = TinTucSuKien::where('tags','=',$ds['tags'])->where('locale', '=', $locale)->paginate(7);
        return view('Frontend.tin-tuc-su-kien-ct')->with(compact('danhsach', 'ds'));
    }
    function tin_tuc_su_kien_xtt(Request $request, $locale = '', $id = '', $key = 0) {
        $ds = TinTucSuKien::find($id);
        $key = intval($key);
        echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;min-height:80vh;height:100% !important;" />';
    }
    function tin_tuc_su_kien_tv(Request $request, $locale='', $id = '', $key = 0) {
        $ds = TinTucSuKien::find($id);
        $key = intval($key);

        $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
        $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
        return Storage::download($file_path, $name);
    }
    function doi_tac(Request $request, $locale = '') {
        $danhsach = DoiTac::where('locale', '=', $locale)->orderBy('date_post', 'desc')->paginate(9);
        return view('Frontend.doi-tac')->with(compact('danhsach'));
    }
    function doi_tac_ct(Request $request, $locale = '', $slug = '') {
        $ds = DoiTac::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
        $danhsach = DoiTac::where('locale', '=', $locale)->paginate(9);
        return view('Frontend.doi-tac-ct')->with(compact('danhsach', 'ds'));
    }
    function hoi_nghi_hoi_thao(Request $request, $locale = '') {
        $danhsach = HoiNghiHoiThao::where('locale', '=', $locale)->paginate(9);
        return view('Frontend.hoi-nghi-hoi-thao')->with(compact('danhsach'));
    }
    function hoi_nghi_hoi_thao_ct(Request $request, $locale = '', $slug = '') {
        $ds = HoiNghiHoiThao::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
        $danhsach = HoiNghiHoiThao::where('locale', '=', $locale)->paginate(9);
        return view('Frontend.hoi-nghi-hoi-thao-ct')->with(compact('danhsach', 'ds'));
    }
    function hoi_nghi_hoi_thao_xtt(Request $request, $locale = '', $id = '', $key = 0) {
        $ds = HoiNghiHoiThao::find($id);
        $key = intval($key);
        echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;min-height:80vh;height:100% !important;" />';
    }
    function hoi_nghi_hoi_thao_tv(Request $request, $locale='', $id = '', $key = 0) {
        $ds = HoiNghiHoiThao::find($id);
        $key = intval($key);
        $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
        $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
        return Storage::download($file_path, $name);
    }
    function van_ban(Request $request, $locale = '') {
        $cats = VanBanController::get_cats(); 
        return view('Frontend.van-ban')->with(compact('cats'));
    }
    function van_ban_ct(Request $request, $locale = '', $slug = '') {
        $ds = VanBan::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
        $danhsach = VanBan::where('cats','=',$ds['cats'])->where('locale', '=', $locale)->paginate(7);
        return view('Frontend.van-ban-ct')->with(compact('danhsach', 'ds'));
    }
    function van_ban_tv(Request $request, $locale='', $id = '', $key = 0) {
        $ds = VanBan::find($id);$key = intval($key);
        $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
        $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
        return Storage::download($file_path, $name);
    }
    function bieu_mau(Request $request, $locale = '') {
        $cats = BieuMauController::get_cats(); 
        return view('Frontend.bieu-mau')->with(compact('cats'));
    }
    function bieu_mau_ct(Request $request, $locale = '', $slug = '') {
        $ds = BieuMau::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
        $danhsach = BieuMau::where('cats','=',$ds['cats'])->where('locale', '=', $locale)->paginate(7);
        return view('Frontend.bieu-mau-ct')->with(compact('danhsach', 'ds'));
    }
    function bieu_mau_tv(Request $request, $locale='', $id = '', $key = 0) {
        $ds = BieuMau::find($id);$key = intval($key);
        $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
        $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
        return Storage::download($file_path, $name);
    }
    // function cong_bo_khoa_hoc(Request $request, $locale = '') {
    //     $danhsach = CongBoKhoaHoc::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(20);
    //     return view('Frontend.cong-bo-khoa-hoc')->with(compact('danhsach'));
    // }
    // function cong_bo_khoa_hoc_ct(Request $request, $locale = '', $slug='') {
    //     $ds = CongBoKhoaHoc::where('locale', '=', $locale)->where('slug','=',ObjectController::ObjectId($slug))->first();
    //     $danhsach = CongBoKhoaHoc::where('locale', '=', $locale)->orderBy('updated_at', 'desc')->paginate(7);
    //     return view('Frontend.cong-bo-khoa-hoc-ct')->with(compact('danhsach','ds'));
    // }
    function lien_he(Request $request, $locale = '') {
        $file_path = base_path('resources/lang/') . $locale . '/lien-he.txt';
        $noi_dung = file_get_contents($file_path);
        if($locale == 'vi'){
            return view('Frontend.'.$locale.'.lien-he')->with(compact('noi_dung'));
        }
        if($locale == 'en'){
            return view('Frontend.'.$locale.'.contacts')->with(compact('noi_dung'));
        }
    }

    function tong_quan(Request $request, $locale = '') {
        $file_path = base_path('resources/lang/') . $locale . '/tong-quan.txt';
        $noi_dung = file_get_contents($file_path);
        if($locale == 'vi'){
            return view('Frontend.'.$locale.'.tong-quan')->with(compact('noi_dung'));
        }
        if($locale == 'en'){
            return view('Frontend.'.$locale.'.overview')->with(compact('noi_dung'));
        }
    }
    function chuyen_gia(Request $request, $locale = '') {
        $danhsach = NhanSu::where('locale','=',$locale)->where('tags','=','chuyen-gia')->orderBy('thu_tu', 'asc')->get();
        if($locale == 'vi'){
            return view('Frontend.'.$locale.'.chuyen-gia')->with(compact('danhsach'));
        }
        if($locale == 'en'){
            return view('Frontend.'.$locale.'.experts')->with(compact('danhsach'));
        }
    }

    function nhan_su(Request $request, $locale = '') {
        $danhsach = NhanSu::where('locale','=',$locale)->where('tags','=','nhan-su')->orderBy('thu_tu', 'asc')->get();
        if($locale == 'vi') {
            return view('Frontend.'.$locale.'.nhan-su')->with(compact('danhsach'));
        }
        if($locale == 'en') {
            return view('Frontend.'.$locale.'.organizational-structure')->with(compact('danhsach'));
        }
    }

    // function dich_vu(Request $request, $locale = '', $slug = '') {
    //     $ds = DichVu::where('locale', '=', $locale)->where('slug','=',$slug)->first();
    //     $danhsach = DichVu::where('locale', '=', $locale)->get();
    //     return view('Frontend.dich-vu')->with(compact('ds', 'danhsach'));
    // }

    // function dich_vu_xtt(Request $request, $locale = '', $id = '', $key = 0) {
    //     $ds = DichVu::find($id);
    //     $key = intval($key);
    //     echo '<embed src="'.env('APP_URL').'storage/files/'.$ds['attachments'][$key]['aliasname'].'" style="width:100%;min-height:80vh;height:100% !important;" />';
    // }

    // function dich_vu_tv(Request $request, $locale='', $id = '', $key = 0) {
    //     $ds = DichVu::find($id);
    //     $key = intval($key);
    //     $file_path = 'public/files/' . $ds['attachments'][$key]['aliasname'];
    //     $name  = Str::slug($ds['attachments'][$key]['title'], '-') . '.' . $ds['attachments'][$key]['type'];
    //     return Storage::download($file_path, $name);
    // }
    function chuyen_gia_va_doi_tac(Request $request, $locale = '') {
        if($locale == 'vi') {

        }
        if($locale == 'en') {
            return view('Frontend.'.$locale.'.experts-and-partners');
        }
    }
    // function hinh_anh_hoat_dong(Request $request, $locale = '') {
    //     $danhsach = HinhAnh::where('locale', '=', $locale)->orderBy('date_post', 'desc')->paginate(9);
    //     return view('Frontend.hinh-anh-hoat-dong')->with(compact('danhsach'));
    // }
    // function hinh_anh_hoat_dong_ct(Request $request, $locale = '', $slug = '') {
    //     $ds = HinhAnh::where('locale', '=', $locale)->where('slug', '=', $slug)->first();
    //     $danhsach = HinhAnh::where('locale', '=', $locale)->paginate(9);
    //     return view('Frontend.hinh-anh-hoat-dong-ct')->with(compact('danhsach', 'ds'));
    // }

    function search(Request $request, $locale = 'vi') {
        $q = $request->input('q');
        $danhsach = TinTucSuKien::where('locale', '=', $locale)->where('ten', 'regexp', '/.*'.$q.'/i')->orderBy('date_post', 'desc')->paginate(9);
        return view('Frontend.tim-kiem')->with(compact('danhsach','q'));
    }

    function dao_tao(Request $request, $locale = 'vi', $slug = '') {
        echo storage_path();
    }
   
}
