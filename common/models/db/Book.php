<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-8
 * Time: 下午9:54
 */

namespace common\models\db;


class Book extends \common\models\db\base\Book
{
    /**
     * 其实就是书名页上的内容，应包括书名、作者名、出版地、出版者名、版权说明、定价、书号（杂志才是刊号）、印张、印数、版次、印刷单位、发行单位
     */
}