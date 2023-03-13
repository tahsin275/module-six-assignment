<?php
// Read user information from CSV file
$file = fopen('users.csv', 'r');
$users = [];
while (($data = fgetcsv($file)) !== FALSE) {
    $users[] = $data;
}
fclose($file);
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Information</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h1>User Information</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Profile Picture</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user[0]; ?></td>
                    <td><?php echo $user[1]; ?></td>
                    <td><img src="<?php echo $user[2]; ?>" height="50"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
