<button class="btn">
    <a href="/user/profile?id=<?= $data->info->id ?>""><i style="outline: none;" class="fa-solid fa-arrow-left fa-2x hov-i"></i></a>
</button>
<section>
    <div class="container py-5">
        <div class="row">
            <div class="form-img col-lg-5 p-0 pb-3">
                <form action="/users/update_img" method="POST" enctype="multipart/form-data">
                    <div class="cent opac">
                        <div class="card card-profile height-card mt-4">
                            <div class="card-body text-center">
                                <img class="img-style mb-2" name="img" src="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/<?= $data->info->img ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                <input type="file" id="uplode-img-edit" class="form-control" name="upload" style="background-color: #ddd;">

                                <div class="d-flex justify-content-center mb-2">
                                    <button type="submit" class="btn btn-warning mt-3">Update Img</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="form-info col-lg-7">
                <form action="/user/up_pro" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $data->info->id ?>">
                    <div class="card card-profile opac mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <lable class="mb-0">Name</lable>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="display_name" value="<?= $data->info->display_name ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Username</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="username" value="<?= $data->info->username ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" value="<?= $data->info->email ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Current Password</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password" value="<?= $data->info->password ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">New Password</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="new-password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex justify-content-center mb-2">

                                    <button type="submit" class="btn btn-warning mt-3">Update</button>

                                    <a href="/user/profile?id=<?= $data->info->id ?>"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>