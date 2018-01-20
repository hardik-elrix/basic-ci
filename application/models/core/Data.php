<?php
/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 17-01-2018
 * Time: 12:18
 */

class Data extends CI_Model
{
    public static $CI;

    function __construct()
    {
        parent::__construct();
        self::$CI = $this;
        $this->datetime = Common::date();
        $this->ip = Common::ip();
    }

    public static function select($data, $array = true)
    {
        self::$CI->db->select($data ["select"]);
        self::$CI->db->from($data ["table"]);

        if (isset($data ["where"])) {
            self::$CI->db->where($data ["where"]);
        }

        if (isset($data ["where_or"])) {
            die("Please Use GROUP query for OR WHERE");
            // self::$CI->db->or_where($data ["where_or"]);
        }

        if (isset($data ["or_where_in"])) {
            die("Please Use GROUP query for OR WHERE IN");
            /*
             * foreach ($data ["or_where_in"] as $k => $v) {
             * self::$CI->db->or_where_in($k, $v);
             * }
             */
        }

        if (isset($data ["where_in"])) {
            foreach ($data ["where_in"] as $k => $v) {
                self::$CI->db->where_in($k, $v);
            }
        }

        if (isset($data["where_not_in"])) {
            foreach ($data["where_not_in"] as $k => $v) {
                self::$CI->db->where_not_in($k, $v);
            }
        }

        if (isset($data ["like"])) {
            self::$CI->db->like($data ["like"] [0], $data ["like"] [1], $data ["like"] [2]);
        }
        if (isset($data ["or_like"])) {
            die("Please Use GROUP query for OR LIKE");
            /*
             * foreach ($data ["or_like"] as $k => $v) {
             * self::$CI->db->or_like($v [0], $v [1], $v [2]);
             * }
             */
        }

        /* Handling GROUPING for Query */
        if (isset($data ["group"])) {
            self::$CI->db->group_start();
            if (isset($data ["group"] ["like"])) {
                self::$CI->db->like($data ["group"] ["like"] [0], $data ["group"] ["like"] [1], $data ["group"] ["like"] [2]);
            }
            if (isset($data ["group"] ["or_like"])) {
                foreach ($data ["group"] ["or_like"] as $k => $v) {
                    self::$CI->db->or_like($v [0], $v [1], $v [2]);
                }
            }
            if (isset($data ["group"] ["where"])) {
                self::$CI->db->or_where($data ["group"] ["where"]);
            }

            if (isset($data ["group"] ["where_or"])) {
                self::$CI->db->or_where($data ["group"] ["where_or"]);
            }
            self::$CI->db->group_end();
        }

        if (isset($data ["order"])) {
            self::$CI->db->order_by($data ["order"]);
        }
        if (isset($data ["skip"])) {
            self::$CI->db->limit($data ["limit"], $data ["skip"]);
        } elseif (isset($data ["limit"])) {
            self::$CI->db->limit($data ["limit"]);
        }

        if (isset($data ["groupBy"])) {
            self::$CI->db->group_by($data ["groupBy"]);
        }

        if ($array) {
            $result = self::$CI->db->get()->result_array();
        } else {
            $result = self::$CI->db->get()->result();
        }

        return $result;
    }

    public static function select_join($data, $array = true)
    {
        self::$CI->db->select($data["select"]);
        self::$CI->db->from($data['table']);
        foreach ($data['join'] as $key => $value) {
            if (isset($data['join'][$key]['type']) && !empty($data['join'][$key]['type'])) {
                self::$CI->db->join($value['table'], $value['on'], $value['type']);
            } else {
                self::$CI->db->join($value['table'], $value['on']);
            }
        }

        if (isset($data ["group_by"])) {
            self::$CI->db->group_by($data ["group_by"]);
        }

        if (isset($data ["where"])) {
            self::$CI->db->where($data ["where"]);
        }

        if (isset($data["having"])) {
            self::$CI->db->having($data["having"]);
        }

        if (isset($data["order"])) {
            self::$CI->db->order_by($data["order"]);
        }

        if (isset($data["skip"])) {
            self::$CI->db->limit($data["limit"], $data ["skip"]);
        } elseif (isset($data["limit"])) {
            self::$CI->db->limit($data["limit"]);
        }

        //return
        if ($array == true) {
            return self::$CI->db->get()->result_array();
        } else {
            return self::$CI->db->get()->result();
        }
    }

    public static function custom($sql)
    {
        return self::$CI->db->query($sql)->result_array();
    }

    public static function insert($data, $duplicate = false)
    {
        $result = false;
        if (self::$CI->db->insert($data ["table"], $data ["insert"]) !== false) {
            $result = self::$CI->db->insert_id();
        }
        if ($duplicate === true && self::duplicates_check() === true) {
            return false;
        } else {
            return $result;
        }
    }

    public static function update($data)
    {
        if (isset($data ["where_in"])) {
            foreach ($data ["where_in"] as $k => $v) {
                self::$CI->db->where_in($k, $v);
            }
        }
        self::$CI->db->where($data ["where"])->update($data ["table"], $data ["update"]);
        /*$result = false;
        if (self::$CI->db->affected_rows() > 0) {
            $result = true;
        }*/
        if (self::$CI->db->error()["code"] == 0) {
            return true;
        } else {
            return false;
        }

        //return $result;
    }

    public static function delete($data)
    {
        if (isset($data ["where_in"])) {
            foreach ($data ["where_in"] as $k => $v) {
                self::$CI->db->where_in($k, $v);
            }
        }
        self::$CI->db->where($data ["where"]);
        self::$CI->db->delete($data ["table"]);

        $result = false;
        if (self::$CI->db->affected_rows() > 0) {
            $result = true;
        }
        return $result;
    }

    public static function duplicates_check()
    {
        if (self::$CI->db->error()["code"] == 1062) {
            return true;
        } else {
            return false;
        }
    }
}