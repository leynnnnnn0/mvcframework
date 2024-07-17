<?php
use app\model\LoginForm;

/** @var $model LoginForm*/

?>
<div class="container">
    <h1>Log in</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="<?= $model->email ?>"
            >
            <p class="text-danger"><?= $model->getFirstError('email') ?></p>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"

            >
            <p class="text-danger"><?= $model->getFirstError('password') ?></p>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="/login">Login</a>
</div>
