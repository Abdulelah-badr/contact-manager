<h2>Contacts</h2>

<?php if (isset($_SESSION['admin_id'])) { ?>
    <a href="index.php?action=add" class="btn">Add Contact</a>
<?php } ?>

<?php if (count($contacts) == 0) { ?>
    <p>No contacts found.</p>
<?php } else { ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date Added</th>
            <?php if (isset($_SESSION['admin_id'])) { ?>
                <th></th>
            <?php } ?>
        </tr>
        <?php foreach ($contacts as $contact) { ?>
            <tr>
                <td><?php echo htmlspecialchars($contact['name']); ?></td>
                <td><?php echo htmlspecialchars($contact['email']); ?></td>
                <td><?php echo htmlspecialchars($contact['phone']); ?></td>
                <td><?php echo date('d/m/Y', strtotime($contact['created_at'])); ?></td>
                <?php if (isset($_SESSION['admin_id'])) { ?>
                    <td>
                        <a href="index.php?action=edit&id=<?php echo $contact['id']; ?>" class="btn small">Edit</a>
                        <form method="post" action="index.php?action=delete&id=<?php echo $contact['id']; ?>" style="display:inline" onsubmit="return confirm('Delete this contact?')">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                            <input type="submit" value="Delete" class="btn small red">
                        </form>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
<?php } ?>
