<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Auth;
use DB;
use App\Test;

class TestController extends Controller
{
    //
    public function showallmsg()
    {
        //DB::table('tests')->all();--json_encode((array)
        $msge=Test::all();
        $msg = &$msge;
        return json_encode($msg);
    }
    public function viewmsg()//介面設計
    {//介面

      if (Auth::check()||Auth::user()) {
        $ver=Auth::user()->email_verified_at;
        if(!is_null($ver)){
          return view('showmsg');
        }else{
          return view('noverification');
        }
      }else{
        return view('nologinshow');
      }

    }
    public function logout(){//登出
      if (Auth::check()) {
        Auth::logout();
      }
      return view('welcome');
    }
    public function newmsg(Request $request)
    {//新增留言
        $return_msg_info=array(
      "status" => "ture",
      "msg"    => "第"
    );
        $return_errmsg_info=array(
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
          $r['name']=Auth::user()->name;
          $r['email']=Auth::user()->email;
            $validator = Validator::make(
                $r,
                [//驗證
            'name'         => ['required','alpha_num','max:50'],
            'email'        => ['required','email'],//限制字母 數字
            'title'     => ['required','alpha_num','max:50'],
            'msg'      => ['required','alpha_num'],
          ]
            );
            if ($validator->fails()) {
                $return_err=array_merge_recursive((array)$return_err, (array)$return_errmsg_info);
                foreach ($validator->messages()->all() as $message) {//直接validator取的錯誤值
                    $return_errmsg_info['msg']="";
                    $return_errmsg_info['msg'] .= $message;// .=疊加
                    $return_err=array_merge_recursive($return_err, (array)$return_errmsg_info['msg']);
                }
                echo json_encode((array)$return_err);
            } else {
                $pro = Test::create($r);
                $return_login_info['msg']=$r['msg'];
                $id = DB::table('tests')->pluck('id');
                $id_ret=0;
                foreach ($id as  $value) {
                    $id_ret=$value;
                }
                $r['id']=$id_ret;
                $r['time']=date('Y-m-d H:i:s');
                echo json_encode((array)$r);
            }
        }
    }
    public function deletemsg(Request $request)
    {//刪除
        $return_msg_info=array(
        "status" => "ture",
        "msg"    => "第"
      );
        $return_errmsg_info=array(
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
            $log=DB::table('tests')->where('id', $r['id'])->delete();
            return json_encode((array)$r['id']);
        }
    }
    public function updat(Request $request)
    {
        $return_msg_info=array(
        "status" => "ture",
        "msg"    => "第"
      );
        $return_errmsg_info=array(
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
            'id'         => ['required','alpha_num','max:50'],
          ]
            );
            if ($validator->fails()) {
                $return_err=array_merge_recursive((array)$return_err, (array)$return_errmsg_info);
                foreach ($validator->messages()->all() as $message) {//直接validator取的錯誤值
                    $return_errmsg_info['msg']="";
                    $return_errmsg_info['msg'] .= $message;// .=疊加
                    $return_err=array_merge_recursive($return_err, (array)$return_errmsg_info['msg']);
                }
                echo json_encode((array)$return_err);
            } else {
                $log=DB::table('tests')->where('id', $r['id'])->first();
                return json_encode((array)$log);
            }
        }
    }

    public function updatemsg(Request $request)
    {//更新
        $return_msg_info=array(
        "status" => "ture",
        "msg"    => "第"
      );
        $return_errmsg_info=array(
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
            'id'        => ['required'],
            'title'     => ['required','alpha_num','max:50'],
            'msg'      => ['required','string'],
          ]
            );
            if ($validator->fails()) {
                $return_err=array_merge_recursive((array)$return_err, (array)$return_errmsg_info);
                foreach ($validator->messages()->all() as $message) {//直接validator取的錯誤值
                    $return_errmsg_info['msg']="";
                    $return_errmsg_info['msg'] .= $message;// .=疊加
                    $return_err=array_merge_recursive($return_err, (array)$return_errmsg_info['msg']);
                }

                echo json_encode((array)$return_err);
            } else {
                $pro = DB::table('tests')->where('id', $r['id'])->update([
              "title"  =>$r['title'],
              "msg"    =>$r['msg']
            ]);
                $pro = DB::table('tests')->where('id', $r['id'])->first();
                echo json_encode((array)$pro);
            }
        }
    }
}
