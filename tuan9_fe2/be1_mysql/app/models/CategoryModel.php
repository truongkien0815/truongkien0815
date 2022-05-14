<?php
class CategoryModel extends Db
{
    //Lấy tất cả danh mục
    public function getCategories()
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM categories");
        return parent::select($sql);
    }
}