<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/5/17
 * Time: 8:55 AM
 */

namespace common\components\tools;


class ArrayHelper
{
    /**
     * @param $arr 需要处理的数组
     * @param array $out 输出的结果
     * @param int $deep 键深
     * @param array $k_attr 键说明
     * @param array $v_attr 值说明
     */
    public static function arr_info($arr, &$out = [], &$deep = 0, $k_attr = [], $v_attr = [])
    {
        if (is_array($arr)){
            $deep++;
            foreach($arr as $k => $v){
                $attr1 = null;
                foreach ($k_attr as $k1 => $v1){
                    if ($k1 == $k){
                        $attr1 = $v1;
                    }
                }
                $attr2 = null;
                foreach ($k_attr as $k1 => $v1){
                    if ($k1 == $v){
                        $attr2 = $v1;
                    }
                }
                $out[] = [
                    'k' => $k,
                    'v' => is_array($v)?null:$v,
                    'deep' => $deep,
                    'k_attr' => $attr1,
                    'v_attr' => $attr2,
                ];
                $fun = __FUNCTION__;
                self::$fun($v, $out, $deep, $k_attr, $v_attr);
            }
            $deep--;
        }
    }

    /**
     * 字符串转换为数组，主要用于把分隔符调整到第二个参数
     * @param  string $str  要分割的字符串
     * @param  string $glue 分割符
     * @return array
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public static function str2arr($str, $glue = ','){
        $arr = explode($glue, $str);
        return array_filter($arr);
    }
    /**
     * 数组转换为字符串，主要用于把分隔符调整到第二个参数
     * @param  array  $arr  要连接的数组
     * @param  string $glue 分割符
     * @return string
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public static function arr2str($arr, $glue = ','){
        return implode($glue, $arr);
    }

    /**
     * 把返回的数据集转换成Tree
     * @param array $list 要转换的数据集
     * @param string $pid parent标记字段
     * @param string $level level标记字段
     * @return array
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public static function list2tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0) {
        // 创建Tree
        $tree = [];
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = [];
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId =  $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }
    /**
     * 将list2tree的树还原成列表
     * @param  array $tree  原来的树
     * @param  string $child 孩子节点的键
     * @param  string $order 排序显示的键，一般是主键 升序排列
     * @param  array  $list  过渡用的中间数组，
     * @return array        返回排过序的列表数组
     * @author yangweijie <yangweijiester@gmail.com>
     */
    public static function tree2list($tree, $child = '_child', $order='id', &$list = []){
        if(is_array($tree)) {
            $refer = [];
            foreach ($tree as $key => $value) {
                $reffer = $value;
                if(isset($reffer[$child])){
                    unset($reffer[$child]);
                    self::tree2list($value[$child], $child, $order, $list);
                }
                $list[] = $reffer;
            }
            $list = self::list_sort_by($list, $order, $sortby='asc');
        }
        return $list;
    }

    /**
     * 对查询结果集进行排序
     * @access public
     * @param array $list 查询结果
     * @param string $field 排序的字段名
     * @param array $sortby 排序类型
     * asc正向排序 desc逆向排序 nat自然排序
     * @return array
     */
    public static function list_sort_by($list, $field, $sortby = 'asc')
    {
        if (is_array($list)) {
            $refer = $resultSet = array();
            foreach ($list as $i => $data)
                $refer[$i] = &$data[$field];
            switch ($sortby) {
                case 'asc': // 正向排序
                    asort($refer);
                    break;
                case 'desc':// 逆向排序
                    arsort($refer);
                    break;
                case 'nat': // 自然排序
                    natcasesort($refer);
                    break;
            }
            foreach ($refer as $key => $val)
                $resultSet[] = &$list[$key];
            return $resultSet;
        }
        return false;
    }

    /**
     * 获取节点所有父级元素
     * @param array $list 数据
     * @param int $node_id 节点id
     * @param int $pk 主键
     * @param int $pid 外键
     * @param int $root 根节点
     * @return array 父节点
     * @author wodrow <wodrow451611cv@gmail.com | 1173957281@qq.com>
     */
    public static function get_list_parents($list,$node_id,$pk='id',$pid='pid',$root=0)
    {
        $i = $root;
        while($node_id!=$root){
            foreach ($list as $k => $v){
                if ($v[$pk]==$node_id){
                    $node_to_root[$i++] = $k;
                    $node_id = $v[$pid];
                }
            }
        }
        $i = $i-1;
        for($i;$i>=$root;$i--){
            $root_to_node[] = $node_to_root[$i];
            $parent_list[] = $list[$node_to_root[$i]];
        }
        return $parent_list;
    }

    /**
     * 获取节点排序
     * @param array $tree 数据
     * @param int $node_id 节点id
     * @param int $start 起始值
     * @param string $sort_name 排序字段下标
     * @param array $p
     * @return array 带节点排序的数据
     * @author wodrow <wodrow451611cv@gmail.com | 1173957281@qq.com>
     */
    public static function get_tree_node_sort($tree,$start=0,$sort_name='_node_sort',&$p=[]){
        $start++;
        foreach ($tree as $k => $v) {
            $p[$k] = $v;
            $p[$k][$sort_name] = $start-1;
            if ($v['_child']) {
                self::get_tree_node_sort($v['_child'],$start,$sort_name,$p[$k]['_child']);
            }
        }
        return $p;
    }

    /**
     * 获取list数组单个字段值
     * @param array $list 数组
     * @param int $key 索引键
     * @param int $search 索引值
     * @param int $field 查询键
     * @return int|string 查询值
     * @author wodrow <wodrow451611cv@gmail.com | 1173957281@qq.com>
     */
    public static function get_list_field($list,$key,$search,$field){
        foreach ($list as $k => $v){
            if($v[$key]==$search){
                return $v[$field];
            }
        }
    }

    /**
     * 获取二维数组的一个键的值的和
     * @param $arr [[]]
     * @param $k
     * @return int amount
     */
    public static function get_arr_k_amount($arr, $k)
    {
        $x = 0;
        foreach ($arr as $key => $v) {
            $x += $v[$k];
        }
        return $x;
    }

    /**
     * 从数组中删除空白的元素（包括只有空白字符的元素）
     *
     * 用法：
     * @code php
     * $arr = array('', 'test', '   ');
     * ArrayHelper::removeEmpty($arr);
     *
     * dump($arr);
     *   // 输出结果中将只有 'test'
     * @endcode
     *
     * @param array $arr 要处理的数组
     * @param boolean $trim 是否对数组元素调用 trim 函数
     */
    public static function removeEmpty(& $arr, $trim = TRUE)
    {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                self::removeEmpty($arr[$key]);
            } else {
                $value = trim($value);
                if ($value == '') {
                    unset($arr[$key]);
                } elseif ($trim) {
                    $arr[$key] = $value;
                }
            }
        }
    }

    /**
     * 从一个二维数组中返回指定键的所有值
     *
     * 用法：
     * @code php
     * $rows = array(
     *     array('id' => 1, 'value' => '1-1'),
     *     array('id' => 2, 'value' => '2-1'),
     * );
     * $values = ArrayHelper::getCols($rows, 'value');
     *
     * dump($values);
     *   // 输出结果为
     *   // array(
     *   //   '1-1',
     *   //   '2-1',
     *   // )
     * @endcode
     *
     * @param array $arr 数据源
     * @param string $col 要查询的键
     *
     * @return array 包含指定键所有值的数组
     */
    public static function getCols($arr, $col, $add_quotation_marks = false)
    {
        $ret = array();
        foreach ($arr as $row) {
            if (isset($row[$col])) {
                if ($add_quotation_marks && is_string($row[$col])) {
                    $ret[] = "'" . $row[$col] . "'";
                } else {
                    $ret[] = $row[$col];
                }
            }
        }
        return $ret;
    }

    /**
     * 将一个二维数组转换为 HashMap，并返回结果
     *
     * 用法1：
     * @code php
     * $rows = array(
     *     array('id' => 1, 'value' => '1-1'),
     *     array('id' => 2, 'value' => '2-1'),
     * );
     * $hashmap = ArrayHelper::toHashmap($rows, 'id', 'value');
     *
     * dump($hashmap);
     *   // 输出结果为
     *   // array(
     *   //   1 => '1-1',
     *   //   2 => '2-1',
     *   // )
     * @endcode
     *
     * 如果省略 $valueField 参数，则转换结果每一项为包含该项所有数据的数组。
     *
     * 用法2：
     * @code php
     * $rows = array(
     *     array('id' => 1, 'value' => '1-1'),
     *     array('id' => 2, 'value' => '2-1'),
     * );
     * $hashmap = ArrayHelper::toHashmap($rows, 'id');
     *
     * dump($hashmap);
     *   // 输出结果为
     *   // array(
     *   //   1 => array('id' => 1, 'value' => '1-1'),
     *   //   2 => array('id' => 2, 'value' => '2-1'),
     *   // )
     * @endcode
     *
     * @param array $arr 数据源
     * @param string $keyField 按照什么键的值进行转换
     * @param string $valueField 对应的键值
     *
     * @return array 转换后的 HashMap 样式数组
     */
    public static function toHashmap($arr, $keyField, $valueField = NULL)
    {
        $ret = array();
        if ($valueField) {
            foreach ($arr as $row) {
                $ret[$row[$keyField]] = $row[$valueField];
            }
        } else {
            foreach ($arr as $row) {
                $ret[$row[$keyField]] = $row;
            }
        }
        return $ret;
    }
    /**
     * 将一个二维数组按照指定字段的值分组
     *
     * 用法：
     * @endcode
     *
     * @param array $arr 数据源
     * @param string $keyField 作为分组依据的键名
     *
     * @return array 分组后的结果
     */
    public static function groupBy($arr, $keyField)
    {
        $ret = array();
        foreach ($arr as $row) {
            $key = $row[$keyField];
            $ret[$key][] = $row;
        }
        return $ret;
    }
    /**
     * 将一个平面的二维数组按照指定的字段转换为树状结构
     *
     *
     * 如果要获得任意节点为根的子树，可以使用 $refs 参数：
     * @code php
     * $refs = null;
     * $tree = ArrayHelper::tree($rows, 'id', 'parent', 'nodes', $refs);
     *
     * // 输出 id 为 3 的节点及其所有子节点
     * $id = 3;
     * dump($refs[$id]);
     * @endcode
     *
     * @param array $arr 数据源
     * @param string $keyNodeId 节点ID字段名
     * @param string $keyParentId 节点父ID字段名
     * @param string $keyChildrens 保存子节点的字段名
     * @param boolean $refs 是否在返回结果中包含节点引用
     *
     * return array 树形结构的数组
     */
    public static function toTree($arr, $keyNodeId, $keyParentId = 'parent_id', $keyChildrens = 'childrens', & $refs = NULL)
    {
        $refs = array();
        foreach ($arr as $offset => $row) {
            $arr[$offset][$keyChildrens] = array();
            $refs[$row[$keyNodeId]] =& $arr[$offset];
        }
        $tree = array();
        foreach ($arr as $offset => $row) {
            $parentId = $row[$keyParentId];
            if ($parentId) {
                if (!isset($refs[$parentId])) {
                    $tree[] =& $arr[$offset];
                    continue;
                }
                $parent =& $refs[$parentId];
                $parent[$keyChildrens][] =& $arr[$offset];
            } else {
                $tree[] =& $arr[$offset];
            }
        }
        return $tree;
    }
    /**
     * 将树形数组展开为平面的数组
     *
     * 这个方法是 tree() 方法的逆向操作。
     *
     * @param array $tree 树形数组
     * @param string $keyChildrens 包含子节点的键名
     *
     * @return array 展开后的数组
     */
    public static function treeToArray($tree, $keyChildrens = 'childrens')
    {
        $ret = array();
        if (isset($tree[$keyChildrens]) && is_array($tree[$keyChildrens])) {
            foreach ($tree[$keyChildrens] as $child) {
                $ret = array_merge($ret, self::treeToArray($child, $keyChildrens));
            }
            unset($ret[$keyChildrens]);
            $ret[] = $tree;
        } else {
            $ret[] = $tree;
        }
        return $ret;
    }
    /**
     * 根据指定的键对数组排序
     *
     * @endcode
     *
     * @param array $array 要排序的数组
     * @param string $keyname 排序的键
     * @param int $dir 排序方向
     *
     * @return array 排序后的数组
     */
    public static function sortByCol($array, $keyname, $dir = SORT_ASC)
    {
        return self::sortByMultiCols($array, array($keyname => $dir));
    }
    /**
     * 将一个二维数组按照多个列进行排序，类似 SQL 语句中的 ORDER BY
     *
     * 用法：
     * @code php
     * $rows = ArrayHelper::sortByMultiCols($rows, array(
     *     'parent' => SORT_ASC,
     *     'name' => SORT_DESC,
     * ));
     * @endcode
     *
     * @param array $rowset 要排序的数组
     * @param array $args 排序的键
     *
     * @return array 排序后的数组
     */
    public static function sortByMultiCols($rowset, $args)
    {
        $sortArray = array();
        $sortRule = '';
        foreach ($args as $sortField => $sortDir) {
            foreach ($rowset as $offset => $row) {
                $sortArray[$sortField][$offset] = $row[$sortField];
            }
            $sortRule .= '$sortArray[\'' . $sortField . '\'], ' . $sortDir . ', ';
        }
        if (empty($sortArray) || empty($sortRule)) {
            return $rowset;
        }
        eval('array_multisort(' . $sortRule . '$rowset);');
        return $rowset;
    }

    /**
     * 对2维数组或者多维数组排序
     * @param $arrays
     * @param $sort_key
     * @param int $sort_order
     *    SORT_ASC - 默认，按升序排列。(A-Z)
     *    SORT_DESC - 按降序排列。(Z-A)
     * @param int $sort_type SORT_ASC - 默认，按升序排列。(A-Z)
     *    SORT_REGULAR - 默认。将每一项按常规顺序排列。
     *    SORT_NUMERIC - 将每一项按数字顺序排列。
     *    SORT_STRING - 将每一项按字母顺序排列
     * @return array|bool
     */
    public static function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC )
    {
        if(is_array($arrays)){
            foreach ($arrays as $array){
                if(is_array($array)){
                    $key_arrays[] = $array[$sort_key];
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
        return $arrays;
    }

    /**
     * 在一维数组里获取一个随机值
     * @param $arr
     * @return mixed
     */
    public static function getAnRandomValueFromArray($arr)
    {
        $total = count($arr);
        $limit = $total - 1;
        $x = rand(0, $limit);
        return $arr[$x];
    }

    /**
     * 格式化打印数组
     */
    public static function h5print($arr)
    {
        echo "<pre>";
        var_export($arr);
        echo "</pre>";
    }
}