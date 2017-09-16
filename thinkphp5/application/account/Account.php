<?php
/**
 * Created by PhpStorm.
 * User: w441
 * Date: 2017/9/13
 * Time: 18:01
 */

namespace app\account;

use think\Db;

//Account objective
class Account{
    //All attributes used in the 3 functions
    protected $user_id;
    protected $user_pwd;
    protected $user_country;
    protected $user_email;
    protected $user_image;
    protected $user_name;
    protected $user_pay;

    //all set() functions
    public function set_user_id($user_id){
        $this->user_id = $user_id;
    }

    public function set_user_pwd($user_pwd){
        $this->user_pwd = $user_pwd;
    }

    public function set_user_country($user_country){
        $this->user_country = $user_country;
    }

    public function set_user_email($user_email){
        $this->user_email = $user_email;
    }

    public function set_user_image($user_image){
        $this->user_image = $user_image;
    }

    public function set_user_name($user_name){
        $this->user_name = $user_name;
    }

    public function set_user_pay($user_pay){
        $this->user_pay = $user_pay;
    }

    //all get() functions
    public function get_user_id(){
        return $this->user_id;
    }

    public function get_user_pwd(){
        return $this->user_pwd;
    }

    public function get_user_country(){
        return $this->user_country;
    }

    public function get_user_email(){
        return $this->user_email;
    }

    public function get_user_name(){
        return $this->user_name;
    }

    public function get_user_image(){
        return $this->user_image;
    }

    public function get_user_pay(){
        return $this->user_pay;
    }

    //log in
    public function log_in(){
        $login = Db::table('user_info')
            ->where('user_email',$this->user_email)
            ->where('user_pwd',$this->user_pwd)
            ->find();
        if($login == null){
            return false;
        }
        else{
            return true;
        }
    }

    //sign up
    public function sign_up(){
        $data = [ 'user_pwd' => $this->user_pwd
            , 'user_email' => $this->user_email];
        if(!$this->id_exist()){
            Db::table('user_info')->insert($data);
            return true;
        }
        else{
            return false;
        }
    }

    //reset password
    public function reset_pwd(){
        $check = Db::table('user_info')
            ->where('user_email',$this->user_email)
            ->find();
        if($check != null){
            Db::table('user_info')
                ->where('user_email', $this->user_email)
                ->update(['user_pwd' => $this->user_pwd]);
            return true;
        }
        else{
            return false;
        }
    }

    //write status to json
    public static function json($status) {
        if (! is_bool ( $status )) {
            return '';
        }
        if($status == true){
            $result = array (
                'status' => "true",
            );
        }
        else{
            $result = array (
                'status' => "false",
            );
        }
        echo json_encode ( $result,JSON_UNESCAPED_UNICODE);
    }

    //check if id already exists
    public function id_exist(){
        $check = Db::table('user_info')
            ->where('user_id',$this->user_id)
            ->find();
        if($check == null){
            return false;
        }
        else{
            return true;
        }
    }
}