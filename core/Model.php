<?php

namespace Core;

class Model extends Database
{
    protected $db;

    protected $table;

    protected $s_column;

    private $query;

    private $where = [];

    private $str_where = '';

    public function __construct()
    {
        parent::__construct();
        $this->db = parent::getDB();
    }

    public function select(...$column)
    {
        // dd($column, implode(', ', $column));
        $this->query = "SELECT " . implode(',', $column) . " FROM " . $this->table;

        return $this;
    }

    public function where($key, $value)
    {
        // if (!empty($this->query)) {
        //     $this->query .= " WHERE {$key}=:$key, role=:role";
        // }
        $this->where[] = [$key, $value];
        $this->str_where .= "{$key}=:{$key} ";

        return $this;
    }

    public function raw(string $query, array $binds)
    {
        $this->query($query);

        foreach ($binds as $i => $value) {
            $this->bind((int) $i + 1, $value);
        }

        return $this;
    }

    public function first()
    {
        // $this->db->query("SELECT * FROM {$this->table} WHERE ")

        // if (!empty($this->where)) {
        //     $this->query .= " WHERE " . str_replace(" ", " AND ", rtrim($this->str_where));
        //     $this->query($this->query);

        //     foreach ($this->where as $w) {
        //         $this->bind($w[0], $w[1]);
        //     }

        //     return $this->result();
        // } else {
        //     $this->query("SELECT * FROM {$this->table} LIMIT 1");
        //     return $this->result();
        // }

        return $this->result();
    }

    public function get()
    {
        return $this->resultAll();
    }

    public function all()
    {
        $this->query("SELECT * FROM {$this->table}");
        return $this->resultAll();
    }
}
