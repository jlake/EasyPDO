EasyPDO
=======

An easy to use PDO wrapper class.

# 1. Connection
```php
    require_once("EasyPDO.php");
    $db = new EasyPDO('mysql:dbname=dummy;host=localhost;charset=UTF8', 'root', '');
```

# 2. CRUD methods
Basic functions for data manipulation.

## select
```php
    $data = $db->select('dummy', '*', 'id <= :max', array(':max'=>100), "id ASC", "0, 3");
    print_r($data);
```

## insert
```php
    $data = array(
        'inf1' => 'test2',
        'inf2' => 'insert'
    );
    $db->insert('dummy', $data);
```

## update
```php
    $data = array(
        'inf1' => 'test3',
        'inf2' => 'update'
    );
    $db->update('dummy', $data, 'id = :id', array(':id' => 3));
```

## delete
```php
    $db->delete('dummy', "id=:id" , array(':id' => 3));
```

## save
If exists then update, else insert.
```php
    $data = array(
        'inf1' => 'test5',
        'inf2' => 'save'
    );
    $db->save('dummy', $data, "inf1=:inf1" , array(':inf1' => 'test5'));
```

# 3. Fetch methods
Just like fetch methods in Zend_Db.

## fetchOne
```php
    $sql = "SELECT inf1 FROM dummy WHERE id = :id";
    $bind = array(
        ':id' => 1
    );
    $data = $db->fetchOne($sql, $bind);
```

## fetchRow
```php
    $sql = "SELECT id, inf1, inf2 FROM dummy WHERE id <= :max ORDER BY id";
    $bind = array(
        ':max' => 100
    );
    $data = $db->fetchRow($sql, $bind);
```

## fetchAll
```php
    $sql = "SELECT id, inf1, inf2 FROM dummy WHERE id BETWEEN :start AND :end ORDER BY id";
    $bind = array(
        ':start' => 1,
        ':end' => 3
    );
    $data = $db->fetchAll($sql, $bind);
```

## fetchAssoc
```php
    $sql = "SELECT inf1, inf2 FROM dummy WHERE id BETWEEN :start AND :end ORDER BY id";
    $bind = array(
        ':start' => 1,
        ':end' => 3
    );
    $data = $db->fetchAssoc($sql, $bind);
```

## fetchPairs
```php
    $sql = "SELECT inf1 AS name, inf2 AS value FROM dummy WHERE id BETWEEN :start AND :end ORDER BY id";
    $bind = array(
        ':start' => 1,
        ':end' => 3
    );
    $data = $db->fetchPairs($sql, $bind);
```

## fetchCol
```php
    $sql = "SELECT inf1 FROM dummy WHERE id BETWEEN :start AND :end ORDER BY id";
    $bind = array(
        ':start' => 1,
        ':end' => 3
    );
    $data = $db->fetchCol($sql, $bind);
```
# 4. Transaction methods
same as original PDO class, but can be nested.

## Example
```php
    try {
        $db->beginTransaction();
        for($i=0; $i < 5; $i++) {
            $db->insert(
                'dummy',
                array(
                    'id'=> rand(1, 10000), 
                    'inf1'=> 'random id', 
                    'inf2'=> 'transaction test'
                )
            );
        }
        $db->commit();
    } catch(PDOException $e) {
        $db->rollback();
    }
```
