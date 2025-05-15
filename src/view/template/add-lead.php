<?php
/* @var string $title */
/* @var string $header */
/* @var string $vendor_url */
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add lead</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <form method="post" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
            <div class="form-group">
                <label for="name"> First Name     </label>
                    <input type="text" class="form-control" name="firstName" required>
                <label for="name"> Last Name  </label>
                    <input type="text" class="form-control" name="lastName" required>
                <label for="name"> Phone </label>
                    <input type="text" class="form-control" name="phone" required>
                <label for="name"> Email </label>
                    <input type="text" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>
