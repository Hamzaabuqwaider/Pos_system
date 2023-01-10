<button class="btn">
    <a href="/user/profile?id=<?= $data->info->id ?>""><i style=" outline: none;" class="fa-solid fa-arrow-left fa-2x hov-i"></i></a>
</button>
<section class="section-profile">
    <div class="form-img pb-3">
        <form action="/users/update_img" method="POST" enctype="multipart/form-data">
            <div class="cent opac">
                <div class="card card-profile height-card mt-4">
                    <div class="card-body text-center">
                        <img class="img-style mb-2" name="img" src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']  ?>/resources/Images/<?= $data->info->img ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <input type="file" id="uplode-img-edit" class="form-control" name="upload" style="background-color: #ddd;">

                        <div class="d-flex justify-content-center mb-2">
                            <button type="submit" class="btn btn-warning mt-3">Update Img</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="form-info ms-3">
        <form action="/user/up_pro" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data->info->id ?>">
            <div class="card card-profile opac mb-4">
                <div class="card-body">
                    <div class="">
                        <p class="mb-1" style="color:red ;font-weight:bold">Name :</p>
                        <input type="text" class="form-control" name="display_name" value="<?= $data->info->display_name ?>">
                    </div>

                    <hr>
                    <div class="">
                        <p class="mb-1" style="color:red ;font-weight:bold">Username :</p>
                        <input type="text" class="form-control" name="username" value="<?= $data->info->username ?>">
                    </div>

                    <hr>
                    <div class="">
                        <p class="mb-1" style="color:red ;font-weight:bold">Email :</p>
                        <input type="text" class="form-control" name="email" value="<?= $data->info->email ?>">
                    </div>
                    <hr>
                    <div class="">
                        <p class="mb-1" style="color:red ;font-weight:bold">New Password :</p>
                        <input type="password" class="form-control" name="new-password">
                    </div>

                    <div class="d-flex justify-content-center mb-2">

                        <button type="submit" class="btn btn-warning mt-3">Update</button>

                        <a href="/user/profile?id=<?= $data->info->id ?>"></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>