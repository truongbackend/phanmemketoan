<?php
return [
    'viettel_post' => [
        "VTP_KEY1" => [
            "index" => 2,
            "column" => "C",
            "column_name" => "Mã đơn hàng",
            "file" => "push_sales",
        ],
        "VTP_KEY2" => [
            "index" => 3,
            "column" => "D",
            "column_name" => "Mã vận đơn",
            "file" => "push_sales",
        ],
        "VTP_KEY3" => [
            "index" => 13,
            "column" => "N",
            "column_name" => "Tên người nhận",
            "file" => "push_sales",
            "get_parent" => true,
        ],
    ]
];
