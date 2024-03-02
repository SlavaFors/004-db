<?php
    class Order extends DatabaseWrapper
    {
        public function __construct(Object $bd)
        {
            $this->bd = $bd;
            parent::__construct($bd, __CLASS__);
            $this->createTable("created_at VARCHAR(20), order_by VARCHAR(20), order_from VARCHAR(20)");
        }
    }