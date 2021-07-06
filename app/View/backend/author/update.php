
<div class="container">
    <form method="post">
        <h3>UPDATE AUTHOR</h3>
        <?php if(isset($author)):?>
        <div class="mb-3">
            <label for="first-name" class="form-label">First Name</label>
            <input type="text" required class="form-control" id="first-name" name="first-name" value="<?php echo $author->getFirstName()?>">
        </div>
        <div class="mb-3">
            <label for="last-name" class="form-label">Last Name</label>
            <input type="text" required class="form-control" id="last-name" name="last-name" value="<?php echo $author->getLastName()?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Password</label>
            <input type="email" required class="form-control" id="email" name="email" value="<?php echo $author->getEmail()?>">
        </div>
        <div class="mb-3">
            <label for="birthdate" class="form-label">Birthdate</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $author->getBirthdate()?>">
        </div>
        <?php endif ?>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


