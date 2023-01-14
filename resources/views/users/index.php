<h1 class="mb-5" style="font-family: 'Roboto', sans-serif;">Users List</h1>

<div class="d-flex justify-content-center align-items-center">
    <div id="scrol-table">
        <table class="table table-bordered tabel-shadow align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 text-center">Name</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->users as $user) : ?>
                    <tr>
                        <td class="text-center">
                            <div class="d-flex align-items-center">
                                <img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/<?= $user->img ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                <div class="ms-3">
                                    <p class="fw-bold text-center"><?= $user->display_name ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="fw-bold text-center"><?= $user->username ?></p>
                        </td>
                        <td>
                            <?php if ($user->status == "Online") { ?>
                                <p class="fw-bold text-center" style="color:green"><?= $user->status ?><i class="fa-solid fa-power-off"></i>
                                </p>

                            <?php } else { ?>
                                <p class="fw-bold text-center" style="color:red;"><?= $user->status ?>
                                    <i class="fa-solid fa-power-off"></i>
                                </p>
                            <?php } ?>
                        </td>

                        <td>
                            <p class="fw-bold text-center"><?= $user->email ?></p>
                        </td>
                        <td class="text-center">
                            <a href="./user?id=<?= $user->id ?>" <i style="text-decoration: none;" class="fa-solid fa-check"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>