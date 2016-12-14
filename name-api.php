<?php
header('Content-Type: application/json');

$cfg = array(
    'db_host' => '127.0.0.1',
    'db_user' => 'root',
    'db_pass' => '',
    'db_name' => 'babynames'
);


// Check post data
if (empty($_POST['name'])) exit('[]');
$name = trim($_POST['name']);
if ($name == '') exit('[]');

// Generate the sql
$l = strlen($name);
$params = array($name);
$score = "IF(name SOUNDS LIKE ?, $l, 0)";

for ($i = 1; $i <= $l; $i++) {
    $params[] = str_replace(
        array('_', '%'),
        array('\_', '\%'),
        mb_substr($name, 0, $i)
    ).'%';
    $score .= '+IF(name LIKE ?, 1, 0)';
}

$params[] = $name;
$sql = "SELECT DISTINCT name, $score as score, geslacht as sex, afkomst as type
    FROM namen
    WHERE name != ?
    ORDER BY score
    DESC LIMIT 10";

// Request results
try {
    $db = new PDO('mysql:host='.$cfg['db_host'].';dbname='.$cfg['db_name'].';charset=utf8', $cfg['db_user'], $cfg['db_pass']);
    $query = $db->prepare($sql);
    $query->execute($params);
    
} catch(PDOException $e) {
    echo "Error: ".$e;
}

// Build the result
$res = array();
while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $res[] = array(
        'name' => $row['name']
    );
}

// Print
echo json_encode($res, JSON_UNESCAPED_UNICODE);
?>