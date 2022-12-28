<div class="card-deck row d-flex justify-content-center align-items-center">
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="card card-y">
            <div class="view overlay">
                <img class="card-img-top" src="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/<?= $data->user->img ?>" alt="Card image cap">
                <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>
            <div class="card-body card-x">
                <!--Title-->
                <h4 class="card-title"><strong><?= $data->user->display_name ?></strong></h4>

                <p class="card-text"><strong><?= $data->user->username ?></strong></p>
                <p class="card-text"><strong><?= $data->user->email ?></strong></p>
                <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                <div class="mt-5 d-flex flex-row justify-content-around gap-3">
                    <a href="/users"><i class="fa-solid fa-backward fa-2x"></i></a>
                    <a href="/users/edit?id=<?= $data->user->id ?>"><i style="color: yellow;" class="fa-solid fa-pen-to-square fa-2x"></i></a>
                    <a href="/users/delete?id=<?= $data->user->id ?>" onclick="return confirm('Are You Sure Delete <?= $data->user->display_name ?>  ?')"><i style="color: red;" class="fa-solid fa-trash fa-2x"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


