<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaiKhoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        $ActionCurrent  = $this->route()->getActionMethod(); // trả về method đang hoạt động 

        switch ($this->method()) {
            case 'POST':
                switch ($ActionCurrent) {
                        // nếu là method thêm mới bản ghi
                    case 'store':
                        $rules = [
                            'name' => 'required',
                            'email' => 'required | email | unique:users,email',
                            'vai_tro_id' => 'numeric | min:1',
                            'password' => 'required | min:6 | max:32',
                            'sdt' => 'required | integer | regex:/(0)[0-9]{9}/ | min:10 | max:11 ',
                            'dia_chi' => 'required',
                            'hinh_anh' => 'required | image',
                        ];
                        break;

                        // nếu là method chỉnh sửa bản ghi
                    case 'update':
                        $rules = [
                            'name' => 'required',
                            'email' => 'required | email',
                            'vai_tro_id' => 'numeric | min:1',
                            'password' => 'required | min:6 | max:32',
                            'sdt' => 'required | integer | regex:/(0)[0-9]{9}/ | min:10 | max:11',
                            'dia_chi' => 'required',
                            'hinh_anh' => 'required | image',
                        ];
                        break;

                    default:
                        # code...
                        break;
                }
                break;

            default:
                # code...
                break;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên tài khoản bắt buộc phải nhập',
            'sdt.required' => 'Số điện thoại bắt buộc phải nhập',
            'sdt.regex' => 'Số điện thoại sai định dạng',
            'sdt.min' => 'Số điện thoại tối thiểu 10 kí tự ',
            'sdt.max' => 'Số điện thoại tối đa 11 kí tự',
            'sdt.integer' => 'Số điện thoại sai định dạng',
            'dia_chi.required' => 'Địa chỉ bắt buộc phải nhập',
            'vai_tro_id.min' => 'Vai trò bắt buộc phải chọn',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Sai định dạng Email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu bắt buộc phải nhập',
            'password.max' => 'Mật khẩu tối đa là 32 kí tự',
            'password.min' => 'Mật khẩu bắt buộc nhiều hơn 6 ký tự',
            'hinh_anh.required' => 'Ảnh đại diện bắt buộc phải chọn',
            'hinh_anh.image' => 'Ảnh đại diện phải có định dạng: jpeg, png, jpg',
            ];
    }
}
