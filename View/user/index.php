
<?php


$db = Connection::getInstance();
$userController = new UserController($db);

$users = $userController->handleRequest();

if (isset($_SESSION['message'])) {
    echo '<p>' . $_SESSION['message'] . '</p>';
    unset($_SESSION['message']);
}

?>



<div class="container">
    <h2>Liste des utilisateurs</h2>
    <a href="/tp/index.php?ctrl=user&action=createForm"><button>Créer</button></a>
    <?php if (isset($users) && !empty($users)) : ?>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Admin</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->getId(); ?></td>
                    <td><?= $user->getEmail(); ?></td>
                    <td><?= $user->getFirstName(); ?></td>
                    <td><?= $user->getLastName(); ?></td>
                    <td><?= $user->getAdmin(); ?></td>
                    <td>
                        <form action="/tp/index.php?ctrl=user&action=delete" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                            <input type="hidden" name="deleteId" value="<?= $user->getId(); ?>" />
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                    <?php if ($_SESSION['admin'] == 1)  {
                        echo '
                        <button>Modifier</button>
                        ';
                    } ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?>
</div>
