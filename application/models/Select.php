<?php

class Select extends CI_Model {

    public function getAllFromTable($table, $limit = null, $start = null) {
        $this->db->select('*');
        $this->db->from($table);
        if (isset($limit)) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllFromTableWhere($table, $cond_col, $cond_val, $limit, $start) {
        $this->db->select('*');
        $this->db->from($table);
        if (is_array($cond_col) && is_array($cond_val)) {
            $i = 0;
            foreach ($cond_col as $col) {
                $this->db->where($col, $cond_val[$i++]);
            }
        } else {
            $this->db->where($cond_col, $cond_val);
        }
        if (isset($limit)) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllRecordInnerJoin($col, $t_name1, $t_name2, $t_1_col, $t_2_col, $cond_col, $cond_value, $limit = null, $start = null) { //$col should be array like $col=array('name','category')
        $field = "`" . implode("`,`", $col) . "`";
        $this->db->select($field);
        $this->db->from($t_name1); //book table
        $this->db->join($t_name2, "$t_name1.$t_1_col = $t_name2.$t_2_col"); //category table
        $this->db->where("$t_name1.$cond_col", $cond_value);
        $this->db->order_by("id", "asc");
        $this->dataLimiter($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllRecordInnerJoinNoCondition($col, $t_name1, $t_name2, $t_1_col, $t_2_col, $limit = null, $start = null) { //$col should be array like $col=array('name','category')
        $field = "`" . implode("`,`", $col) . "`";
        $this->db->select($field);
        $this->db->from($t_name1); //book table
        $this->db->join($t_name2, "$t_name1.$t_1_col = $t_name2.$t_2_col"); //category table
        $this->dataLimiter($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function getSingleRecordInnerJoin($col, $t_name1, $t_name2, $t_1_col, $t_2_col, $cond_col, $cond_value) { //$col should be array like $col=array('name','category')
        $field = "`" . implode("`,`", $col) . "`";
        $this->db->select($field);
        $this->db->from($t_name1); //book table
        $this->db->join($t_name2, "$t_name1.$t_1_col = $t_name2.$t_2_col"); //category table
        $this->db->where("$t_name1.$cond_col", $cond_value);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    public function getSingleRecordInnerJoinThreeTbl($col, $t_name1, $t_name2, $t_name3, $t_1_col, $t_2_col, $t_3_col, $t1_col2, $cond_col, $cond_value, $cond_col2 = null, $cond_val2 = null) { //$col should be array like $col=array('name','category')
        $field = "`" . implode("`,`", $col) . "`";
        $field = "" . implode(",", $col) . "";
        $this->db->select($field);
        $this->db->from($t_name1); //book table
        $this->db->join($t_name2, "$t_name1.$t_1_col = $t_name2.$t_2_col"); //category table
        $this->db->join($t_name3, "$t_name1.$t1_col2 = $t_name3.$t_3_col");
        $this->db->where("$t_name1.$cond_col", $cond_value);
        if (!empty($cond_col2) && !empty($cond_val2)) {
            $this->db->where("$t_name1.$cond_col2", $cond_val2);
        }
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllRecordJoinThreeTbl($col, $t1, $t2, $t3, $t1_c1, $t1_c2, $t2_c1, $t2_c2, $t3_c, $t2_c1_val, $t1_c2_val, $orderByDesc = null, $orderByAsc = null) { //$col should be array like $col=array('name','category')
        $field = "`" . implode("`,`", $col) . "`";
        $field = "" . implode(",", $col) . "";
        $this->db->select($field);
        $this->db->from($t1); //book table
        $this->db->join($t2, "$t2.$t2_c1 = $t1.$t1_c1"); //category table
        $this->db->join($t3, "$t2.$t2_c2 = $t3.$t3_c");
        $this->db->where("$t1.$t1_c2", $t1_c2_val);
        $this->db->where("$t2.$t2_c1", $t2_c1_val);
        if (!empty($orderByDesc)) {
            $this->db->order_by($orderByDesc, "desc");
        }
        if (!empty($orderByAsc)) {
            $this->db->order_by($orderByAsc, "asc");
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getCountFromTable($table, $id, $value) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($id . '<', $value);
        $query = $this->db->get();
        return count($query->result());
    }

    public function getTotalCount($table) {
        $this->db->select("*");
        $this->db->from($table);
        $query = $this->db->get();
        return count($query->result());
    }

    public function getUserDetails($id) {
        $this->db->select('first_name, gender');
        $this->db->from('user');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function search($keyword, $cols, $tablename, $cond_col = null, $cond_val = null) {
        $this->db->select('*');
        $this->db->from($tablename);
        foreach ($cols as $col) {
            $this->db->or_like($col, $keyword);
            if (isset($cond_col) && isset($cond_val)) {
                $this->db->where($cond_col, $cond_val);
            }
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function searchAllRecords($keyword, $cols, $tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $i = 1;
        $j = 0;
        $where_query = "";
        foreach ($cols as $col) {
            if (count($cols) == $i) {
                $where_query .= "`" . $col . "` LIKE '%" . $keyword[$j] . "%';";
            } else {
                $where_query .= "`" . $col . "` LIKE '%" . $keyword[$j] . "%' AND ";
            }
            $i++;
            $j++;
        }
        $this->db->where($where_query);
        $query = $this->db->get();
        return $query->result();
    }

    public function getSingleRecord($table, $id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getSingleRecordWhere($table, $cond_col, $cond_val) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($cond_col, $cond_val);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getSingleRecordWhereMultiValue($table, $cond_col, $cond_val, $cond_col2, $cond_val2) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($cond_col, $cond_val);
        $this->db->where($cond_col2, $cond_val2);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getSingleWhereMultiValue($table, $cond_col_array, $cond_val_array) {
        $this->db->select('*');
        $this->db->from($table);
        $i = 0;
        foreach ($cond_col_array as $cond_col) {
            $this->db->where($cond_col, $cond_val_array[$i]);
            $i++;
        }
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function dataLimiter($limit, $start) {
        if (isset($limit)) {
            $this->db->limit($limit, $start);
        }
    }

}
