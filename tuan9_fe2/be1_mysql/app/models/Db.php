<?php
class Db
{
    public static $connection = NULL;
    // 1. Tạo connection
    public function __construct()
    {
        if(!self::$connection) {
            self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
            self::$connection->set_charset('utf8mb4');
        }
        
        return self::$connection;
    }

    // 3. Execute select
    public function select($sql)
    {
        //Mảng chứa kết quả trả về
        $items = [];
        //Hàm thực thi
        $sql->execute();
        //Lấy kết quả từ db, sau đó đọc từng dòng kết quả và chuyển thành dạng mảng associative
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
}
