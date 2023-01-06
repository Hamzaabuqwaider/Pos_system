<div class="d-flex justify-content-center align-items-center">
    <div class="card card-y">
        <div class="view overlay">
            <img class="card-img-top" src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']  ?>/resources/Images/<?= $data->user->img ?>" alt="Card image cap">
        </div>
        <div class="card-body card-x">
            <!--Title-->
            <h4 class="card-title"><strong><?= $data->user->display_name ?></strong></h4>

            <p class="card-text"><strong><?= $data->user->username ?></strong></p>
            <p class="card-text"><strong><?= $data->user->email ?></strong></p>
            <p class="card-text"><strong>created_at <?= $data->user->created_at ?></strong></p>
            <p class="card-text"><strong>updated_at <?= $data->user->updated_at ?></strong></p>
            <div class="mt-5 d-flex flex-row justify-content-around gap-3">
                <a href="/users"><i class="fa-solid fa-backward fa-2x"></i></a>
                <a href="/users/edit?id=<?= $data->user->id ?>"><i style="color: yellow;" class="fa-solid fa-pen-to-square fa-2x"></i></a>
                <a href="/users/delete?id=<?= $data->user->id ?>" onclick="return confirm('Are You Sure Delete <?= $data->user->display_name ?>  ?')"><i style="color: red;" class="fa-solid fa-trash fa-2x"></i></a>
            </div>
        </div>
    </div>
</div>