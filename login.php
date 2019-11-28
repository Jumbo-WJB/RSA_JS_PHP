<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 9:48
 */
header('Content-type:text/html;charset=utf-8');

//私钥
$private_key = "-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDbHqVytV9dnIrfCS9dzDVZz+qM6LtU46cdqbGvvX0Xz4CtsiT+
TqU3m8eC9BwTd0jY8bWjatYqEn716H77JcIJpmvO6ZJc4JYxvyJx6BEj6TQ4ZGYl
CA/wT08s9TKwd+PjkEht9A51hvCuUiyHPzMXAiL0a9tghPVd5rcDHlXb5wIDAQAB
AoGBANhrD2wZWYSi7cJWVxMkc3kuUvIzl3rDkrZIeXgjBp9y0hw8fC80zBf9Y3Oi
2Owc/7VOHmG2TqqlNAJ7TJePdnGvEG5yzHuMH6/uRPS4A+gDndM8U/sZBUYaZjbr
5M8vg6wL3yQ2awAbXu7pwLEvxVmuvhv+0jOFnqLpTRlki3ZpAkEA+Y00pTwikCEt
N+dkFGbhzZfH6bFNIkUOCrkDMgru1IargO/ggllk4fVLe7WBMWwh/0X9oTeTjLi7
Es856QMdpQJBAODIIeu7/cL3wp6Bigg7V25OSD+7uSjlCpoPSUNZIjZ6HJQsFCnU
RHsEDeD1f88g7i9AGI0htYiJXCgwd6GE9ZsCQGoCUhrfMM+JSGw3H4yLJ+DuWT4s
01d7fjuP3IulmU8u5iwfun+k+fYC/c3PjNIx3T9TvCqAMW3WC6Ix5afWawECQA6p
n2TUL3pvVPen9YwR6uMcIiReJ3becfGYu6uz/cJV9tVHhs0vtoPbwNgCy6KEQGU+
phtWrpPIegV5G+SiWq8CQQCoH+ic1j9b1DzENUb206w7KpcIhm629iUWUgBTrnlC
LzOA6xwY78V7cAUdzhTycAxhmWq/1FBlCCKtuZHVHnE/
-----END RSA PRIVATE KEY-----";

$hex_encrypt_data = trim($_POST['password']); //十六进制数据
$encrypt_data = pack("H*", $hex_encrypt_data);//对十六进制数据进行转换
openssl_private_decrypt($encrypt_data, $decrypt_data, $private_key);

// echo '解密后的数据：' . $decrypt_data;
$aaaa = "$decrypt_data";
define('SQL_HOST','127.0.0.1');//数据库地址
define("SQL_USER","root");//数据库用户名
define("SQL_PASSWORD","root");//数据库密码
define("SQL_DATABASE","dvwa");//连接的数据库名字
define("SQL_PORT","3306");//数据库端口号,默认为3306
//define("SQL_SOCKDET","");
$mysql = mysqli_connect(SQL_HOST,SQL_USER,SQL_PASSWORD,SQL_DATABASE,SQL_PORT) or  die(mysqli_error());

//连接不上切换数据库
//mysqli_select_db(SQLDATABASE);
//查询语句
$sql = "SELECT first_name, last_name FROM users WHERE user_id = $aaaa";
// echo $sql;
//查询
$results = $mysql -> query($sql);

print_r($results);
//遍历循环打印数据
while ($row = mysqli_fetch_array($results))
{
//    print_r($row);
    echo $row['first_name'];
    echo "<br>";
}
//释放
mysqli_free_result($results);
//关闭连接
mysqli_close($mysql);
