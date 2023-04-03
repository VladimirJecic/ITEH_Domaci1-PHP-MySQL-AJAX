<?php
class Database
{

    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname;
    public $dblink;//veza sa bazom,sesija?
    public $result;//, mysqli_result objekat , pamte se informacije iz baze
    public $records;//ukupan broj redova koji su vraceni iz baze kroz rezultate
    public $affected;//broj svih izmenjenih redova nakon izvrsenja upita
    public $last_id;//poslednji id generisan sa auto-inkrementom

    function __construct($par_dbname)
    {
        $this->dbname = $par_dbname;
        $this->Connect();
    }

    function Connect()
    {
        $this->dblink = new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
        if($this->dblink->connect_errno){
            printf("Konekcija neuspesna: %s\n", $this->dblink->connect_error);
            exit();
        }
        $this->dblink->set_charset("utf8");
    }
    function ExecuteQuery($query){
        // f-ja query kao rezultat vraca mysqli_result objekat koji je Iterator
        //koji ima razlicite stvari u sebi:moze da fetchuje object,moze da vidi koliko ima redova rezultat itd. 
        $this->result = $this->dblink->query($query);
        //ako result nije null ulazimo u if
        if($this->result){
            //ako je query koji smo radili vratio broj redova >0, kod upita sa SELECT
            //pritom num_rows je property objecta mysqli_result
           // if(isset($this->result->num_rows)){
              //  $this->records = $this->result->num_rows;
           // }
            //u slucaju UPDATE,INSERT,DELETE dobicemo broj izmenjenih redova
            if(isset($this->dblink->affected_rows)){
                $this->affected = $this->dblink->affected_rows;
            }
            if(isset($this->dblink->insert_id)){
                $this->last_id = $this->dblink->insert_id;
            }
            return true;
        }else{
            return false;
        }
    }
    function select($table="novost",$rows="*",$join_table="kategorija",$join_key1="id",$join_key2="id",$where=null,$order=null){
        //SELECT * 
        //FROM novost JOIN kategorija ON (novost.kategorija_id=kategorija.id)
        //WHERE ...
        //ORDER ...
        $query= 'SELECT '.$rows.' FROM '.$table;
        if($join_table!=null){
            
            $query .= ' JOIN '.$join_table.' ON '.'('.$table.'.'.$join_key1.'='.$join_table.'.'.$join_key2.')';
        }
        if($where!=null){
            $query .= ' WHERE '.$where;
        }
        if($order!=null){
            $query .= 'ORDER_BY'.$order;
        }
        echo $query;
        $this->ExecuteQuery($query);

    }
    function insert($table="perfume",$column_names= array('name','gender','brand_id','tester','quantity','price','image_id'),$column_values=null ){
        //INSERT INTO NOVOST(...) VALUES(...)
        
        if($column_names!=null && $column_values!=null){
            $q = 'INSERT INTO '.$table.'('.implode(',',$column_names).') VALUES('.implode(',',$column_values).')';
            echo($q);
            if($this->ExecuteQuery($q)){
                return true;
            }else{
                return false; 
            }
        }
    }
    function update($table="novost",$column_names= array('naslov','tekst','datumvreme','kategorija_id'),$column_values=null,$where=null){
        $array= array();
        if($column_names!=null && $column_values!=null && $where!=null){
            if(count($column_names) == count($column_values)){
                $count = count($column_names);
                for($i=0;$i<$count;$i++){
                    $array[$i] = $column_names[$i].'='.$column_values[$i];
                }
            }
            $q = 'UPDATE '.$table.' SET '.implode(',',$array).' WHERE '.$where;
            echo($q);
            if($this->ExecuteQuery($q)){
                return true;
            }else{
                return false;
            }
        }
        return null;
    }
    function delete($table="novost",$where=null){
        if($table!=null && $where!=null){
            $q = 'DELETE FROM '.$table.' WHERE '.$where;
            echo($q);
            if($this->ExecuteQuery($q)){
                return true;
            }else{
                return false;
            }
        }
        return -1;

    }

}

?>