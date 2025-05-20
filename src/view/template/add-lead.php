<?php

use App\form\AddLeadForm;

/* @var AddLeadForm $form */
/* @var string $error */

?>
<?php if (empty($error)) : ?>
<?php else : ?>
    <p class="red">Error Api Connect: <?= $error ?></p>
<?php endif; ?>
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
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="firstName"><?= $form->getLabel('firstName') ?></label>
                <input
                        type="text"
                        class="form-control <?= $form->hasErrors('firstName') ? 'is-invalid' : '' ?>"
                        name="firstName"
                        value="<?= $form->firstName ?>">
                <?php if ($form->hasErrors('firstName')) : ?>
                    <div class="invalid-feedback">
                        <?= $form->getErrors('firstName') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="lastName"><?= $form->getLabel('lastName') ?></label>
                <input
                        type="text"
                        class="form-control <?= $form->hasErrors('lastName') ? 'is-invalid' : '' ?>"
                        name="lastName"
                        value="<?= $form->lastName ?>">
                <?php if ($form->hasErrors('lastName')) : ?>
                    <div class="invalid-feedback">
                        <?= $form->getErrors('lastName') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="phone"><?= $form->getLabel('phone') ?></label>
                <input
                        type="text"
                        class="form-control <?= $form->hasErrors('phone') ? 'is-invalid' : '' ?>"
                        name="phone"
                        value="<?= $form->phone ?>">
                <?php if ($form->hasErrors('phone')) : ?>
                    <div class="invalid-feedback">
                        <?= $form->getErrors('phone') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email"> <?= $form->getLabel('email') ?></label>
                <input
                        type="text"
                        class="form-control <?= $form->hasErrors('email') ? 'is-invalid' : '' ?>"
                        name="email"
                        value="<?= $form->email ?>">
                <?php if ($form->hasErrors('email')) : ?>
                    <div class="invalid-feedback">
                        <?= $form->getErrors('email') ?>
                    </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</div>

