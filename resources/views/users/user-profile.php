    <section class="section-profile">
        <div class="">
            <div class="card card-profile height-card mb-4">
                <div class="card-body text-center">
                    <img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/<?= $data->info->img ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3"><?= $data->info->display_name ?></h5>

                    <div class="d-flex justify-content-center mb-2">
                        <a href="/users/edit_profile?id=<?= $data->info->id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ms-3">
            <div class="card card-profile height-card mb-4">
                <div class="card-body">
                    <div class="col-sm-3">
                        <p class="mb-0">Name</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted1 mb-0"><?= $data->info->display_name ?></p>
                    </div>
                    <hr>
                    <div class="col-sm-3">
                        <p class="mb-0">Username</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted1 mb-0" style="font-weight: bold;"><?= $data->info->username ?></p>
                    </div>
                    <hr>
                    <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted1 mb-0" style="font-weight: bold;"><?= $data->info->email ?></p>
                    </div>
                    <hr>
                    <div class="col-sm-3">
                        <p class="mb-0">Created At</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted1 mb-0" style="font-weight: bold;"><?= $data->info->created_at ?></p>
                    </div>
                    <hr>
                    <div class="col-sm-3">
                        <p class="mb-0">Updated At</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted1 mb-0" style="font-weight: bold; color:white;"><?= $data->info->updated_at ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>