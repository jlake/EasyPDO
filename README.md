EasyPDO
=======

An easy to use PDO wrapper class.

# Connection

    include("EasyPDO.php");
    $db = new EasyPDO('mysql:dbname=dummy;host=localhost;charset=UTF8', 'root', '');

# CRUD methods
Basic functions for data manipulation.

## select

    $data = $db->select('dummy', '*', 'id <= :max', array(':max'=>100), "id ASC", "0, 3");
    print_r($data);

## insert

    $data = array(
        'inf1' => 'test2',
        'inf2' => 'insert'
    );
    $db->insert('dummy', $data);

## update

    $data = array(
        'inf1' => 'test3',
        'inf2' => 'update'
    );
    $data = $db->update('dummy', $data, 'id = :id', array(':id' => 3);

## delete

    $db->delete('dummy', "id=:id" , array(':id' => 3));

## save
If exists then update, else insert.

    $data = array(
        'inf1' => 'test5',
        'inf2' => 'save'.rand(1, 100)
    );
    $db->save('dummy', $data, "id = :id" , array(':id' => 5));


# Fetch methods
Just like fetch methods in Zend_Db.

## fetchOne
    $sql = "SELECT id, inf1, inf2 FROM dummy WHERE id <= :max ORDER BY id";
    $bind = array(
        ':max' => 100
    );
    $data = $db->fetchOne($sql, $bind);

## fetchRow

    $sql = "SELECT id, inf1, inf2 FROM dummy WHERE id <= :max ORDER BY id";
    $bind = array(
        ':max' => 100
    );
    $data = $db->fetchRow($sql, $bind);

## fetchAll
    $sql = "SELECT id, inf1, inf2 FROM dummy WHERE id BETWEEN :start AND :end ORDER BY id";
    $bind = array(
        ':start' => 1,
        ':end' => 3
    );
    $data = $db->fetchAll($sql, $bind);

## fetchAssoc

    $sql = "SELECT inf1, inf2 FROM dummy WHERE ID BETWEEN :start AND :end ORDER BY id";
    $bind = array(
        ':start' => 1,
        ':end' => 3
    );
    $data = $db->fetchAssoc($sql, $bind);

## fetchPairs

    $sql = "SELECT inf1, inf2 FROM dummy WHERE ID BETWEEN :start AND :end ORDER BY id";
    $bind = array(
        ':start' => 1,
        ':end' => 3
    );
    $data = $db->fetchPairs($sql, $bind);

## fetchCol

    $sql = "SELECT inf1 FROM dummy WHERE ID BETWEEN :start AND :end ORDER BY id";
    $bind = array(
        ':start' => 1,
        ':end' => 3
    );
    $data = $db->fetchCol($sql, $bind);

