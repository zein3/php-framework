<html>
    <head>
        <title>Testing</title>
    </head>
    <body>
        <h1>Hello <?= $data['name'] ?></h1>
        <?php if(isset($data['roles'])): ?>
            <ol>Roles
            <?php foreach ($data['roles'] as $role): ?>
                <li><?= $role->name ?></li>
            <?php endforeach; ?>
            </ol>
        <?php endif; ?>
        <pre>
            <?= var_dump($_GET) ?>
        </pre>
    </body>
</html>