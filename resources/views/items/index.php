<h1 class="mb-5" style="font-family: 'Roboto', sans-serif;">Items Page</h1>
<hr>
<!-- <div class="container my-5"> -->
<div class="d-flex justify-content-center align-items-center">
    <div id="scrol-table">
        <table class="table table-bordered tabel-shadow align-middle mb-0 bg-white">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">cost</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($data->items as $item) : ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="ms-3">
                                    <p class="fw-bold mb-1"><?= $i++ ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="fw-bold text-center mt-2"><?= $item->title ?></p>
                        </td>

                        <td class="text-center pt-2">$<?= $item->cost ?></td>
                        <td class="text-center pt-2">$<?= $item->price ?></td>
                        <td class="text-center"><?= $item->quantity ?></td>
                        <td class="text-center">
                            <a href="./item?id=<?= $item->id; ?>" <i style="text-decoration: none;" class="fa-solid fa-check"></a></i>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
</div>