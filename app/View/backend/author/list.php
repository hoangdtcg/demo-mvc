
<div class="container">
    <a href="index.php?page=create-author">ADD AUTHOR</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Avatar</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Email</th>
            <th scope="col">Birthdate</th>
            <th scope="col" colspan="2">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($authors)) {
            foreach ($authors as $author) :?>
                <tr>
                    <th scope="row"><?php echo $author->getId() ?></th>
                    <td><img width="150px" src="<?php echo $author->getUrlImage() ?>" alt=""></td>
                    <td><?php echo $author->getFirstName() ?></td>
                    <td><?php echo $author->getLastName() ?></td>
                    <td><?php echo $author->getEmail() ?></td>
                    <td><?php echo $author->getBirthdate() ?></td>
                    <td><a href="index.php?page=update-author&id=<?php echo $author->getId()?>" class="btn btn-warning btn-lg">Edit</a></td>
                    <td><a href="index.php?page=delete-author&id=<?php echo $author->getId()?>" class="btn btn-danger btn-lg">Delete</a></td>
                </tr>
            <?php endforeach;
        } ?>
        </tbody>
    </table>
</div>

<?php include_once '../layouts/footer.php' ?>

