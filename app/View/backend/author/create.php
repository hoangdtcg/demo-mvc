
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <h3>CREATE AUTHOR</h3>
        <div class="mb-3">
            <label for="first-name" class="form-label">First Name</label>
            <input type="text" required class="form-control" id="first-name" name="first-name">
        </div>
        <div class="mb-3">
            <label for="last-name" class="form-label">Last Name</label>
            <input type="text" required class="form-control" id="last-name" name="last-name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Password</label>
            <input type="email" required class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="birthdate" class="form-label">Birthdate</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate">
        </div>
        <div class="mb-3">
            <label for="avt" class="form-label">Avatar</label>
            <input type="file" class="form-control" id="avt" name="fileToUpload">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

