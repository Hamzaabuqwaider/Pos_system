<?php

use Core\Helpers\Helper; ?>
<div class="row">
    <?php if (Helper::check_permission(['user:read'])) {  ?>
        <div class="col-sm-9 col-lg-4 col-md-4 w-auto ps-2 mb-4 ">
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


        <div class="col-lg-4 col-md-4 w-auto ps-2 mb-4">
            <a href="/items">
                <div id="Card-2" class="card-2">
                    <div class="card-body">

                        <h5 class="card-title text-center">Total Items</h5>
                        <div class="d-flex justify-content-center flex-column align-items-center">

                            <i class="icon-cog fa-solid fa-layer-group fa-2x mb-2 mt-3"></i>

                            <p class="card-text paragrahp"><strong><?= $data->items_count_all ?></strong></p>

                        </div>
                    </div>
                </div>
            </a>
        </div>





        <div class="col-lg-4 col-md-4 w-auto  ps-2 mb-3">
            <a href="/transactions/page">
                <div id="Card-3" class="card-4">
                    <div class="card-body">

                        <h5 class="card-title text-center">Total Sales</h5>
                        <div class="d-flex justify-content-center flex-column align-items-center">

                            <i class="icon-cog fa-solid fa-store fa-2x mb-2 mt-3"></i>
                            <p class="card-text paragrahp">$ <strong><?= number_format($data->total_sales) ?> JOD</strong></p>

                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-4 w-auto  ps-2 mb-3">
            <a href="/accounts/page">
                <div id="Card-4" class="card-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Transaction</h5>
                        <div class="d-flex justify-content-center flex-column align-items-center">
                            <i class="fa-solid fa-cart-shopping fa-layer-group fa-2x mb-2 mt-3"></i>
                            <p class="card-text paragrahp"><strong><?= $data->transaction_count ?></strong></p>

                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-4 col-md-4 w-auto ps-2 mb-2">
            <a href="">
                <div id="Card-5" class="card-6">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total quantity items</h5>
                        <div class="d-flex justify-content-center flex-column align-items-center">
                            <i class="fa-solid fa-sigma fa-layer-group fa-2x mb-2 mt-3"></i>
                            <p class="card-text paragrahp"><strong><?= $data->total_quantity ?></strong></p>

                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-4 w-auto ps-2 mb-2">
            <a href="">
                <div id="Card-6" class="card-7">
                    <div class="card-body">
                        <h5 class="card-title text-center">Clear profit</h5>
                        <div class="d-flex justify-content-center flex-column align-items-center">
                            <i class="fa-solid fa-money-check-dollar fa-layer-group fa-2x mb-2 mt-3"></i>
                            <p class="card-text paragrahp">$ <?= number_format($data->profit) ?> JOD</p>

                        </div>
                    </div>
                </div>
            </a>
        </div>

</div>

<!-- <div class="row mt-4"> -->




<!-- </div> -->

<div class="table-style">
    <div class="table-flex">
        <h2 class="text-center">Top <?= $data->items_count ?> Items </h2>

        <table class="table align-middle bg-white table-mobile">
            <thead>
                <tr>
                    <th class="text-center test">#</th>
                    <th class="text-center">Title</th>
                    <th class="text-center test">Cost</th>
                    <th class="text-center">Price</th>
                    <th class="text-center test">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($data->items as $item) : ?>
                    <tr>
                        <td class="test">
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <p class="text-muted mb-0"><?= $i++ ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-muted mb-0 text-center" style="font-weight: bold;"><?= $item->title ?></p>
                        </td>
                        <td class="text-center test">
                            $<?= $item->cost ?>
                        </td>
                        <td class="text-center">$<?= $item->price ?></td>
                        <td class="text-center test">
                            <a href="/item?id=<?= $item->id ?>"><i class="fa-solid fa-1x fa-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <div class="mt-4 table-flex">
        <h3 class="text-center">Total quantity for each Items </h3>
        <div id="scrol-table">
            <table class="table align-middle mb-0 bg-white table-mobile">
                <thead>
                    <tr>
                        <th class="text-center test">#</th>
                        <th class="text-center">Title</th>
                        <th class="text-center test">quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data->item_quantity as $item) : ?>
                        <tr>
                            <td class="test">
                                <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                        <p class="text-muted mb-0"><?= $i++ ?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-muted mb-0 text-center" style="font-weight: bold;"><?= $item->title ?></p>
                            </td>
                            <td class="text-center test">
                                <?= $item->quantity ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } else {

        $_SESSION['message'] = "You do not have permission to access this page";
        $_SESSION['error_type'] = "error";
    } ?>