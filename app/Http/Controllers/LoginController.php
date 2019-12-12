<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class LoginController extends Controller
{
    //
    public function showlogin(Request $request)//介面展示
    {
        return view('login');
    }
    public function login(Request $request)//登入
    {
        $return_login_info=array(
        "status" => "ture",
        "msg"    => "登入成功"
      );
        $return_errlogin_info=array(
        "status" => "false",
        "msg"    => "錯誤訊息",
      );
        $return_err=array();
        set_time_limit(0);//設定運行時間
        //將資料由js轉成php
        $r=$request->all();
        if ($r == null||empty($r) ||!isset($r)) {//
            $return_errlogin_info['msg']="要加雙引號,逗號和{}";
            echo json_encode((array)$return_errlogin_info);
        } else {
            $validator = Validator::make(
                $r,
                [//驗證
            'email'        => ['required','email'],
            'password'     => ['required','alpha_num','max:50'],

          ]
            );
            if ($validator->fails()) {
                $return_err=array_merge_recursive((array)$return_err, (array)$return_errlogin_info);
                foreach ($validator->messages()->all() as $message) {//直接validator取的錯誤值
                    $return_errlogin_info['msg']="";
                    $return_errlogin_info['msg'] .= $message;// .=疊加
                    $return_err=array_merge_recursive($return_err, (array)$return_errlogin_info['msg']);
                }
                echo json_encode((array)$return_err);
            } else {
                $admin=DB::TEST('users')->where('email', $r['email'])->first();
                if ($admin['email']) {
                    $r['password'] = Hash::make($r['password']);
                    if (Hash::needsRehash($r['password'])) {
                        $r['password'] = Hash::make('secret');
                    }
                    if ($r['password']==$admin['password']) {
                        //轉到指定頁面
                        return view('showmsg');
                    } else {
                        $return_errlogin_info['msg']="密碼輸入錯誤";
                        echo json_encode((array)$return_errlogin_info);
                    }
                } else {
                    $return_errlogin_info['msg']="電子郵件輸入錯誤";
                    echo json_encode((array)$return_errlogin_info);
                }
            }
        }
    }
    public function registered(Request $request)
    {//註冊
        $return_login_info=array(
        "status" => "ture",
        "msg"    => "註冊成功，請前往信箱進行驗證"
      );
        $return_errlogin_info=array(
        "status" => "false",
        "msg"    => "錯誤訊息",
      );
        $return_err=array();
        set_time_limit(0);//設定運行時間
        //將資料由js轉成php
        $r=$request->all();
        if ($r == null||empty($r) ||!isset($r)) {//
            $return_errlogin_info['msg']="要加雙引號,逗號和{}";
            echo json_encode((array)$return_errlogin_info);
        } else {
            $validator = Validator::make(
                $r,
                [//驗證
            'email'                => ['required','email'],
            'password'             => ['required','alpha_num','max:50'],
            'password_confirmation'=>['required',"same:password",'alpha_num','max:50'],
            'name'                 => ['required','alpha_num','max:50'],

          ],
                [
            'password_confirmation.same'=>'密碼與確認密碼不相符',
          ]
            );
            if ($validator->fails()) {
                $return_err=array_merge_recursive((array)$return_err, (array)$return_errlogin_info);
                foreach ($validator->messages()->all() as $message) {//直接validator取的錯誤值
                    $return_errlogin_info['msg']="";
                    $return_errlogin_info['msg'] .= $message;// .=疊加
                    $return_err=array_merge_recursive($return_err, (array)$return_errlogin_info['msg']);
                }
                echo json_encode((array)$return_err);
            } else {
                $admin=DB::table('users')->where('email', $r['email'])-first();
                if ($admin) {
                    $return_errlogin_info['msg']="該電子信箱已註冊過了";
                    echo json_encode((array)$return_errlogin_info);
                } else {
                    $r['password']= Hash::make($r['password']);
                    if (Hash::needsRehash($r['password'])) {
                        $r['password'] = Hash::make($r['password']);
                    }
                    $pro= login::create($r);
                    //-------------------------------------------------------------------發送email未做
                }
            }
        }
    }
    public function reset(Request $request)
    {//重置時驗證是否有該會員
        $return_login_info=array(
        "status" => "ture",
        "msg"    => "登入成功"
      );
        $return_errlogin_info=array(
        "status" => "false",
        "msg"    => "錯誤訊息",
      );
        $return_err=array();
        set_time_limit(0);//設定運行時間
        //將資料由js轉成php
        $r=$request->all();
        if ($r == null||empty($r) ||!isset($r)) {//
            $return_errlogin_info['msg']="要加雙引號,逗號和{}";
            echo json_encode((array)$return_errlogin_info);
        } else {
            $validator = Validator::make(
                $r,
                [//驗證
            'email'        => ['required','email'],
            'name'     => ['required','alpha_num','max:50'],

          ]
            );
            if ($validator->fails()) {
                $return_err=array_merge_recursive((array)$return_err, (array)$return_errlogin_info);
                foreach ($validator->messages()->all() as $message) {//直接validator取的錯誤值
                    $return_errlogin_info['msg']="";
                    $return_errlogin_info['msg'] .= $message;// .=疊加
                    $return_err=array_merge_recursive($return_err, (array)$return_errlogin_info['msg']);
                }
                echo json_encode((array)$return_err);
            } else {
                $admin=DB::TEST('users')->where('email', $r['email'])->first();
                if ($admin['email']) {
                    if ($admin['name']==$r['name']) {
                        //----------------------------------------------------------------------轉頁面未完成
                    } else {
                        $return_errlogin_info['msg']="找不到該用戶";
                        echo json_encode((array)$return_errlogin_info);
                    }
                } else {
                    $return_errlogin_info['msg']="找不到該用戶";
                    echo json_encode((array)$return_errlogin_info);
                }
            }
        }
    }
    public function resetpassword(Request $request)
    {//重置密碼
        $return_login_info=array(
        "status" => "ture",
        "msg"    => "註冊成功，請前往信箱進行驗證"
      );
        $return_errlogin_info=array(
        "status" => "false",
        "msg"    => "錯誤訊息",
      );
        $return_err=array();
        set_time_limit(0);//設定運行時間
        //將資料由js轉成php
        $r=$request->all();
        if ($r == null||empty($r) ||!isset($r)) {//
            $return_errlogin_info['msg']="要加雙引號,逗號和{}";
            echo json_encode((array)$return_errlogin_info);
        } else {
            $validator = Validator::make(
                $r,
                [//驗證
            'email'                => ['required','email'],
            'password'             => ['required','alpha_num','max:50'],
            'password_confirmation'=>['required',"same:password",'alpha_num','max:50'],

          ],
                [
            'password_confirmation.same'=>'密碼與確認密碼不相符',
          ]
            );
            if ($validator->fails()) {
                $return_err=array_merge_recursive((array)$return_err, (array)$return_errlogin_info);
                foreach ($validator->messages()->all() as $message) {//直接validator取的錯誤值
                    $return_errlogin_info['msg']="";
                    $return_errlogin_info['msg'] .= $message;// .=疊加
                    $return_err=array_merge_recursive($return_err, (array)$return_errlogin_info['msg']);
                }
                echo json_encode((array)$return_err);
            } else {
                $admin=DB::TEST('users')->where('email', $r['email'])->update(['password' => $r['password']]);
                $return_errlogin_info['msg']="密碼重置完成";
                echo json_encode((array)$return_errlogin_info);
            }
        }
    }
}
