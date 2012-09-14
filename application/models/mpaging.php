<?php
if(!class_exists('MPaging'))
{
    class MPaging extends Model
    {
       
        function MPaging()
        {
                parent::Model();
        }
            
        function getPaging($sql)
        {
            $page = id_clean($_POST['page']);
            $rp = id_clean($_POST['rp']);
            $sortname = db_clean($_POST['sortname']);
            $sortorder = db_clean($_POST['sortorder']);
            $qtype = db_clean($_POST['qtype']);
            $queryx= db_clean($_POST['query']);
            

            if (!$sortname) $sortname = 'name';
            if (!$sortorder) $sortorder = 'desc';

            if($queryx!=''){            	
            		//awas tanda petik khusus mysql
                    //$where = sprintf(" and `%s` LIKE `%%s%` ",$qtype,$queryx);
                    $where = "and `".$qtype."` LIKE '%".$queryx."%' ";
            } else {
                    $where ='';
            }
            $sort = "ORDER BY $sortname $sortorder";

            if (!$page) $page = 1;
            if (!$rp) $rp = 10;
            $start = (($page-1) * $rp);
            $limit = "LIMIT $start, $rp";

            $ret = array();
            $data = array();
            $sqls = sprintf("%s %s %s %s",$sql,$where,$sort, $limit);
            //echo $sqls;
            $q = $this->db->query($sqls);
            $n = $q->num_rows();
            if($n>0)
            {
                    foreach($q->result_array() as $row)
                    {
                            $data[] = $row;
                    }
            }
            $q->free_result();
            $ret["data"] = $data;
            $sqlcount = sprintf("%s %s ",$sql,$where);
            $q = $this->db->query($sqlcount);
            $ret["count"] = $q->num_rows();
            $q->free_result();
            return $ret;
        }
    }
}
?>
