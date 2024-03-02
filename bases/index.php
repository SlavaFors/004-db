<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    spl_autoload_register(function ($file) { include "./bases/".$file.".php"; });

    $data = parse_ini_file("data.ini", true);

    function parse(array &$data, string $type)
    {
        for ($i = 0; $i < 5; $i++)
            $data[$type][$i] = explode(', ', $data[$type][$i]);
    }

    try
    {
        $bd = new PDO("mysql:host=localhost;charset=utf8", "root", "");
        $bd->query("CREATE DATABASE task");
        $bd->query("USE task");

        $poles = array(
            'shop' => "name, address",
            'product' => "name, price, count",
            'order' => "created_at, order_by, order_from",
            'orderProduct' => "_product, _order, price",
            'client' => "name, phone"
        );

        $bases = array(
            'shop'         => new Shop($bd),
            'product'      => new Product($bd),
            'order'        => new Order($bd),
            'orderProduct' => new OrderProduct($bd),
            'client'       => new Client($bd)
        );

        parse($data, "shop");
        parse($data, "product");
        parse($data, "client");

        for ($i = 0; $i < 5; $i++)
            $data["order"][$i] = [ $data["order"][$i], $data["client"][random_int(0, 4)][0], $data["shop"][random_int(0, 4)][0] ];

        for ($i = 0; $i < 5; $i++)
        {
            $product = $data["product"][random_int(0, 4)];
            $data["orderProduct"][$i] = [ $product[0], $data["order"][random_int(0, 4)][0], $product[1] ];
        }

        printf("<pre>%s</pre>", print_r($data, true));

        foreach ($data as $key => $value)
            for ($i = 0; $i < 5; $i++)
                $bases[$key]->insert($poles[$key], implode(', ', $value[$i]));

       // $->insert("column, column", "data, data");
       // $->find(id);
       // $->update(id, [ "column = 'data'" ]);
       // $->delete(id);
        
       // $bd->query("DROP DATABASE task"); // Раскоментировать для очистки 
    }
    catch(PDOException $e) { var_dump($e->getMessage()); }    