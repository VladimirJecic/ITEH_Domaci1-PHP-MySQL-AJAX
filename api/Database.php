<?php
class Database
{

    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname;
    public $dblink; //veza sa bazom,sesija?
    public $result; //, mysqli_result objekat , pamte se informacije iz baze
    public $records; //ukupan broj redova koji su vraceni iz baze kroz rezultate
    public $affected; //broj svih izmenjenih redova nakon izvrsenja upita
    public $last_id; //poslednji id generisan sa auto-inkrementom
    private $last_query;

    function __construct($par_dbname)
    {
        $this->dbname = $par_dbname;
        $this->Connect();
    }
    function __destruct()
    {
        $this->dblink->close();
        //echo "Konekcija prekinuta";
    }
    function getLastQuery(){
        return isset($this->last_query) ? $this->last_query: "";
    }


    function Connect()
    {
        $this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        if ($this->dblink->connect_errno) {
            printf("Konekcija neuspesna: %s\n", $this->dblink->connect_error);
            exit();
        }
        $this->dblink->set_charset("utf8");
        $this->dblink->autocommit(false);
    }
    function rollback()
    {
        $this->dblink->rollback();
    }
    function commit()
    {
        $this->dblink->commit();
    }
    function ExecuteQuery($query)
    {
        $this->last_query= $query."\n";//ne sme ovo da vraca kroz echo jer se ocekuje JSON kod klijenta!!!
        try {
            // f-ja query kao rezultat vraca mysqli_result objekat koji je Iterator
            //koji ima razlicite stvari u sebi:moze da fetchuje object,moze da vidi koliko ima redova rezultat itd. 
            $this->result = $this->dblink->query($query);
            //ako result nije null ulazimo u if
            if ($this->result) {
                //ako je query koji smo radili vratio broj redova >0, kod upita sa SELECT
                //pritom num_rows je property objecta mysqli_result
                // if(isset($this->result->num_rows)){
                //  $this->records = $this->result->num_rows;
                // }
                //u slucaju UPDATE,INSERT,DELETE dobicemo broj izmenjenih redova
                if (isset($this->dblink->affected_rows)) {
                    $this->affected = $this->dblink->affected_rows;
                }
                if (isset($this->dblink->insert_id)) {
                    $this->last_id = $this->dblink->insert_id;
                }

                /* If code reaches this point without errors then commit the data in the database */
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $exception) {
            throw $exception;
        }
    }
    function select(
        $table = "perfume",
        $columns = "*",
        $join_table1 = null,
        $join_table2 = null,
        $join_key11 = "brand_id",
        $join_key12 = "id",
        $join_key21 = "image_id",
        $join_key22 = "id",
        $where = null,
        $order = null
    ) {
        // SELECT * FROM perfume JOIN brand ON (perfume.brand_id=brand.id) JOIN image ON (perfume.image_id=image.id)
        // WHERE LOWER(perfume.name)  LIKE '%versace%' AND perfume.gender = 'M' AND brand.name = 'Versace' AND perfume.tester = 'no'
        // ORDER BY perfume.name desc;

        $query = 'SELECT ' . $columns . ' FROM ' . $table;
        if ($join_table1 != null) {

            $query .= ' JOIN ' . $join_table1 . ' ON ' . '(' . $table . '.' . $join_key11 . '=' . $join_table1 . '.' . $join_key12 . ')';
        }
        if ($join_table2 != null) {

            $query .= ' JOIN ' . $join_table2 . ' ON ' . '(' . $table . '.' . $join_key21 . '=' . $join_table2 . '.' . $join_key22 . ')';
        }
        if ($where != null) {
            $query .= ' WHERE ' . $where;
        }
        if ($order != null) {
            $query .= 'ORDER BY' . $order;
        }
       
        $this->ExecuteQuery($query);

    }
    function insert($table = "perfume", $column_names = array('name', 'gender', 'brand_id', 'tester', 'price', 'image_id'), $column_values = null)
    {
        //INSERT INTO NOVOST(...) VALUES(...)

        if ($column_names != null && $column_values != null) {
            $q = 'INSERT INTO ' . $table . '(' . implode(',', $column_names) . ') VALUES(' . implode(',', $column_values) . ')';
            if ($this->ExecuteQuery($q)) {
                return true;
            } else {
                return false;
            }
        }
    }
    function update($table = "perfume", $column_names = array('name', 'gender', 'brand_id', 'tester', 'price', 'image_id'), $column_values = null, $where = null)
    {
        $array = array();
        if ($column_names != null && $column_values != null && $where != null) {
            if (count($column_names) == count($column_values)) {
                $count = count($column_names);
                for ($i = 0; $i < $count; $i++) {
                    $array[$i] = $column_names[$i] . '=' . $column_values[$i];
                }
            }
            $q = 'UPDATE ' . $table . ' SET ' . implode(',', $array) . ' WHERE ' . $where;
            if ($this->ExecuteQuery($q)) {
                return true;
            } else {
                return false;
            }
        }
        return null;
    }
    function delete($table = "novost", $where = null)
    {
        if ($table != null && $where != null) {
            $q = 'DELETE FROM ' . $table . ' WHERE ' . $where;
            if ($this->ExecuteQuery($q)) {
                return true;
            } else {
                return false;
            }
        }
        return -1;

    }

}

?>