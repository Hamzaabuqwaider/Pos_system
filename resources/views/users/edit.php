<div class="form-body">
    <div class="row">
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h2 class="text-center" style="font-family: monospace;">Edit User</h2>
                    <form action="/users/update" method="POST">
                        <input type="hidden" name="id" value="<?= $data->user->id ?>">
                        <?php
                        if (!empty($_SESSION) && isset($_SESSION['errors']) && !empty($_SESSION['errors'])) : ?>
                            <?php foreach ($_SESSION['errors'] as $errors) : ?>
                                <div class='alert alert-danger mb-3' role='alert'>
                                    <?= $errors ?>
                                </div>
                            <?php endforeach; ?>
                        <?php
                            $_SESSION['errors'] = null;
                        endif; ?>

                        <div class="col-md-12">
                            <input onfocus="this.style.color='#000000'" class="form-control" type="text" name="display_name" value="<?= $data->user->display_name ?>" placeholder="Display Name" required>

                        </div>

                        <div class="col-md-12">
                            <input onfocus="this.style.color='#000000'" class="form-control" type="email" name="email" value="<?= $data->user->email ?>" placeholder="E-mail" required>
                        </div>
                        <div class=" col-md-12">
                            <input onfocus="this.style.color='#000000'" class="form-control" type="text" name="username" value="<?= $data->user->username ?>" placeholder="Username" required>

                        </div>

                        <div class="col-md-12">
                            <input onfocus="this.style.color='#000000'" class="form-control" type="password" name="new-password" placeholder="New Password">

                        </div>

                        <div class="col-md-12">
                            <select class="form-select" id="user-role" aria-label="Role" name="role">
                                <option value="admin">Admin</option>
                                <option value="procurement">Procurement</option>
                                <option value="seller">Seller</option>
                                <option value="account">Accountant</option>
                            </select>
                        </div>

                        <div class="form-button mt-3">
                            <button type="submit" class="btn btn-warning mt-4 mb-2">Update</button>
                            <a href="/user?id=<?= $data->user->id ?>" class="btn btn-danger ms-3 mt-4 mb-2">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>