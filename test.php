<?php
require_once("EasyPDO.php");
$db = new EasyPDO('mysql:dbname=dummy;host=localhost;charset=UTF8', 'root', '');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>EasyPDO - PHP PDO Wrapper Class</title>
    </head>

<h2>Test 1: select</h2>
<pre>
<?php
$data = $db->select('dummy', '*', 'id<:max', array(':max'=>100), "id ASC", "0, 3");
print_r($data);
?>
</pre>

<h2>Test 2: insert</h2>
<pre>
<?php
$data = array(
    'inf1' => 'test2',
    'inf2' => 'insert'
);
$db->insert('dummy', $data);
$data = $db->select('dummy', '*', "inf1='test2'");
print_r($data);
?>
</pre>

<h2>Test 3: update</h2>
<pre>
<?php
$data = array(
    'inf1' => 'test3',
    'inf2' => 'update'
);
$data = $db->update('dummy', $data, 'id=:id', array(':id' => 3));
$data = $db->select('dummy', '*', 'id=:id', array(':id' => 3));
print_r($data);
?>
</pre>

<h2>Test 4: delete</h2>
<pre>
<?php
$db->delete('dummy', "inf1=:inf1" , array(':inf1' => 'test2'));

$data = $db->select('dummy', '*', "inf1=:inf1" , array(':inf1' => 'test2'));
print_r($data);
?>
</pre>

<h2>Test 5: save</h2>
<pre>
<?php
$data = array(
    'inf1' => 'test5',
    'inf2' => 'save'.rand(1, 100)
);
$db->save('dummy', $data, "inf1=:inf1" , array(':inf1' => 'test5'));
$data = $db->select('dummy', '*', "inf1=:inf1", array('inf1'=>'test5'));
print_r($data);
?>
</pre>

<?php
$sql = "SELECT id, inf1, inf2 FROM dummy WHERE id BETWEEN :start AND :end ORDER BY id";
$bind = array(
    ':start' => 1,
    ':end' => 3
);
?>

<h2>Test 6: fetchOne</h2>
<pre>
<?php
$data = $db->fetchOne($sql, $bind);
print_r($data);
?>
</pre>

<h2>Test 6: fetchRow</h2>
<pre>
<?php
$data = $db->fetchRow($sql, $bind);
print_r($data);
?>
</pre>

<h2>Test 7: fetchAll</h2>
<pre>
<?php
$data = $db->fetchAll($sql, $bind);
print_r($data);
?>
</pre>

<h2>Test 8: fetchAssoc</h2>
<pre>
<?php
$data = $db->fetchAssoc($sql, $bind);
print_r($data);
?>
</pre>

<h2>Test 9: fetchPairs</h2>
<pre>
<?php
$sql = "SELECT inf1, inf2 FROM dummy WHERE id BETWEEN :start AND :end ORDER BY id";
$data = $db->fetchPairs($sql, $bind);
print_r($data);
?>
</pre>

<h2>Test 9: fetchCol</h2>
<pre>
<?php
$sql = "SELECT inf1 FROM dummy WHERE id BETWEEN :start AND :end ORDER BY id";
$data = $db->fetchCol($sql, $bind);
print_r($data);
?>
</pre>
    <body>
</html>    
