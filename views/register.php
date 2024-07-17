<?php
use app\model\User;

/** @var $model User*/

?>
<div class="container">
    <h1>Register</h1>
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
            <label for="username" class="form-label">Username</label>
            <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    value="<?= $model->username ?>">
            <p class="text-danger"><?= $model->getFirstError('username') ?></p>
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
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input
                    type="password"
                    class="form-control"
                    id="confirmPassword"
                    name="confirmPassword">
            <p class="text-danger"><?= $model->getFirstError('confirmPassword') ?></p>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="/login">Login</a>
</div>
