<?php

use Core\Helpers\Helper; ?>
<div class="row">
    <?php if (Helper::check_permission(['user:read'])) {  ?>
        <div class="col-lg-3 col-md-6 col-xl-3 w-auto ps-2 mb-4 ">
            <a href="/users">
                <div id="Card-1" class="card-1">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Users</h5>
                        <div class="d-flex justify-content-center flex-column align-items-center">
                            <i class="icon-cog fa-solid fa-users fa-2x"></i>
                            <p class="card-text paragrahp"><strong><?= $data->users_count ?></strong></p>
                        </div>

                    </div>
                </div>
            </a>
        </div>


        <div class="  col-lg-3 col-md-6 col-xl-3 w-auto ps-2 mb-4">
            <a href="/items">
                <div id="Card-2" class="card-2">
                    <div class="card-body">

                        <h5 class="card-title text-center">Total Items</h5>
                        <div class="d-flex justify-content-center flex-column align-items-center">

                            <i class="icon-cog fa-solid fa-layer-group fa-2x mb-2 mt-3"></i>

                            <p class="card-text paragrahp"><strong><?= $data->items_count ?></strong></p>

                        </div>
                    </div>
                </div>
            </a>
        </div>





        <div class="col-lg-3 col-md-6 col-xl-3 w-auto  ps-2 mb-3">
            <a href="/transactions/page">
                <div id="Card-3" class="card-4">
                    <div class="card-body">

                        <h5 class="card-title text-center">Total Sales</h5>
                        <div class="d-flex justify-content-center flex-column align-items-center">

                            <i class="icon-cog fa-solid fa-store fa-2x mb-2 mt-3"></i>
                            <p class="card-text paragrahp">$ <strong><?= $data->total_sales ?></strong></p>

                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-xl-3 w-auto  ps-2 mb-3">
            <a href="/accounts/page">
                <div id="Card-4" class="card-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Transaction</h5>
                        <div class="d-flex justify-content-center flex-column align-items-center">

                            <i class="icon-cog fa-solid fa-layer-group fa-2x mb-2 mt-3"></i>
                            <p class="card-text paragrahp"><strong><?= $data->transaction_count ?></strong></p>

                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-3 col-md-6 col-xl-3 w-auto ps-2 mb-2">
            <a href="">
                <div id="Card-5" class="card-6">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total quantity</h5>
                        <div class="d-flex justify-content-center flex-column align-items-center">

                            <i class="icon-cog fa-solid fa-layer-group fa-2x mb-2 mt-3"></i>
                            <p class="card-text paragrahp"><strong><?= $data->total_quantity ?></strong></p>

                        </div>
                    </div>
                </div>
            </a>
        </div>

</div>

<!-- <div class="row mt-4"> -->




<!-- </div> -->


<div class="row d-flex justify-content-center align-items-center mt-4">
    <h1 class="d-flex justify-content-around mb-5">Top <?= $data->items_count ?> Items </h1>

    <table class="table align-middle mb-0 bg-white">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Title</th>
                <th class="text-center">Cost</th>
                <th class="text-center">Price</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($data->items as $item) : ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="ms-3">
                                <p class="text-muted mb-0"><?= $i++ ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-muted mb-0 text-center"><?= $item->title ?></p>
                    </td>
                    <td class="text-center">
                        $<?= $item->cost ?>
                    </td>
                    <td class="text-center">$<?= $item->price ?></td>
                    <td class="text-center">
                        <a href="/item?id=<?= $item->id ?>"><i class="fa-solid fa-1x fa-eye"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php } else {

        $_SESSION['message'] = "You do not have permission to access this page";
        $_SESSION['error_type'] = "error";
    } ?>