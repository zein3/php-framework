<html>
    <head>
        <title>Testing</title>
    </head>
    <body>
        <h1>Hello <?= $data['name'] ?></h1>
        <?php if(isset($data['roles'])): ?>
            <ol>Roles
            <?php while ($role = $data['roles']->fetch()): ?>
                <li><?= $role['name'] ?></li>
            <?php endwhile; ?>
            </ol>
        <?php endif; ?>
        <pre>
            <?= var_dump($_GET) ?>
        </pre>
    </body>
</html>