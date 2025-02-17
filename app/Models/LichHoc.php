<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LichHoc extends Model
{
    use HasFactory;
    protected $table = 'lich_hoc';
    protected $guarded = [];


    public function index($params, $pagination = true, $perpage)
    {
        if ($pagination) {
            $query = DB::table($this->table)
                ->where($this->table . '.delete_at', '=', 1)
                ->join('lop', 'lop.id', '=', $this->table . '.lop_id')
                ->join('xep_lop', 'xep_lop.id_lop', '=', 'lop.id')
                ->join('dang_ky', 'dang_ky.id_lop', '=', 'lop.id')
                ->join('thanh_toan' , 'dang_ky.id_thanh_toan' , '=' , 'thanh_toan.id')
                ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
                ->select('dang_ky.*', 'lop.*', 'xep_lop.*', 'khoa_hoc.*', $this->table . '.*')
                ->where('dang_ky.id_user', '=', $params['id'])
                ->where('thanh_toan.trang_thai' , '=',2)
                ->orderByRaw($this->table . '.ngay_hoc');



            $list = $query->paginate($perpage);
        } else {
            $query = DB::table($this->table)
                ->where($this->table . '.delete_at', '=', 1)
                ->join('lop', 'lop.id', '=', $this->table . '.lop_id')
                ->join('xep_lop', 'xep_lop.id_lop', '=', 'lop.id')
                ->join('dang_ky', 'dang_ky.id_lop', '=', 'lop.id')
                ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
                ->select('dang_ky.*', 'lop.*', 'xep_lop.*', 'khoa_hoc.*', $this->table . '.*')
                ->where('dang_ky.id_user', '=', $params['id'])
                ->orderByRaw($this->table . '.ngay_hoc');

            $list = $query->get();
        }
        return $list;
    }

    public function create($params)
    {
        $data  = array_merge($params['cols'], [
            // 'created_at' => date('Y-m-d H:i:s'),
            'delete_at' => 1,
        ]);

        $query = DB::table($this->table)->insertGetId($data);
        return $query;
    }


    public function showLichGiaoVien($params, $pagination = true, $perpage)
    {
        if ($pagination) {
            $query = DB::table($this->table)
                ->where($this->table . '.delete_at', '=', 1)
                ->join('lop', 'lop.id', '=', $this->table . '.lop_id')
                ->join('xep_lop', 'xep_lop.id_lop', '=', 'lop.id')
                ->join('dang_ky', 'dang_ky.id_lop', '=', 'lop.id')
                ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
                ->select('dang_ky.*', 'lop.*', 'xep_lop.*', 'khoa_hoc.*', $this->table . '.*')
                ->where('lop.id_giang_vien' ,  '=' , $params['id']);
              
        
            $list = $query->paginate($perpage);
        } else {
            $query = DB::table($this->table)
            ->where($this->table . '.delete_at', '=', 1)
                ->join('lop', 'lop.id', '=', $this->table . '.lop_id')
                ->join('xep_lop', 'xep_lop.id_lop', '=', 'lop.id')
                ->join('dang_ky', 'dang_ky.id_lop', '=', 'lop.id')
                ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
                ->select('dang_ky.*', 'lop.*', 'xep_lop.*', 'khoa_hoc.*', $this->table . '.*')
                ->where('lop.id_giang_vien' ,  '=' , $params['id']);
                // ->where($this->table . '.delete_at', '=', 1)
                // ->join('lop', 'lop.id', '=', $this->table . '.lop_id')
                // ->Where('lop.id_giang_vien' ,  '=' , $params['id'])
                // ->join('xep_lop', 'xep_lop.id_lop', '=', 'lop.id')
                // ->join('dang_ky', 'dang_ky.id_lop', '=', 'lop.id')
                // ->join('khoa_hoc', 'khoa_hoc.id', '=', 'lop.id_khoa_hoc')
                // ->select('dang_ky.*', 'lop.*', 'xep_lop.*', 'khoa_hoc.*', $this->table . '.*');
               
                
              

            $list = $query->get();
        }
        return $list;
    }
}
