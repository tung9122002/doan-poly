<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ThuHoc extends Model
{
    use HasFactory;
    protected $table = "thu_hoc";
    protected $guarded = [];




    public function index($params, $pagination = true, $perpage)
    {
        if ($pagination) {
            $query  = DB::table($this->table)
                ->where($this->table . '.delete_at', '=', 1)
                ->select($this->table . '.*')
                ->orderByDesc($this->table . '.id');
            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.ten_thu', 'like', '%' . $params['keyword']  . '%');
                });
            }
            $list = $query->paginate($perpage)->withQueryString();
        } else {
            $query  = DB::table($this->table)
                ->where($this->table . '.delete_at', '=', 1)
                ->select($this->table . '.*');
                // ->orderByDesc($this->table . '.id');
            if (!empty($params['keyword'])) {
                $query =  $query->where(function ($q) use ($params) {
                    $q->orWhere($this->table . '.ten_thu', 'like', '%' . $params['keyword']  . '%');
                });
            }
            $list = $query->get();
        }
        return $list;
    }

    public function remoAll($params)
    {
        // dd($params['id']['id']);
        $data = [
            'delete_at' => 0
        ];
        $query = DB::table($this->table)
            ->whereIn('id', $params['cols']['id']);
        // dd($query);
        $query = $query->update($data);
        return $query;
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

    // hàm xóa bản ghi theo id
    public function remove($id)
    {
        if (!empty($id)) {
            $query = DB::table($this->table)->where('id', '=', $id);
            $data = [
                'delete_at' => 0
            ];
            $query = $query->update($data);
            return $query;
        }
    }


    // hàm update bản ghi
    public function saveupdate($params)
    {
        $data = array_merge($params['cols'], [
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
        $query =  DB::table($this->table)
            ->where('id', '=', $params['cols']['id'])
            ->update($data);
        return $query;
    }


    //EDIT
    public function show($id)
    {
        if (!empty($id)) {
            $query = DB::table($this->table)
                ->where('id', '=', $id)
                ->first();
            return $query;
        }
    }

    
   
}
