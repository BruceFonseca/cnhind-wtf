<?php
/**
 * Created by PhpStorm.
 * User: Bruce
 * Date: 25/07/2015
 * Time: 22:13
 */

Class User extends CI_Model
{
    function login($username, $password)
    {

        $this -> db -> select('id, username, password, users.dsc_name, user_roles.dsc_name as role');
        $this -> db -> from('users');
        $this->db->join('user_roles', 'user_roles.id_user_roles = users.id_user_roles');
        $this -> db -> where('username', $username);
        $this -> db -> where('password', MD5($password));
        $this -> db -> limit(1);
        // , user_roles.dsc_name
        $query = $this -> db -> get();

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
}