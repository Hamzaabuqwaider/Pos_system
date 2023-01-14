<h1 class="mb-5" style="font-family: 'Roboto', sans-serif;">Items Page</h1>
<!-- <div class="container my-5"> -->
<form action="/item/search" method="get">
    <div class="search_user input-group w-50 m-auto mb-3">
        <input type="text" class="form-control" placeholder="Search for a Item by title" aria-label="Recipient's username" aria-describedby="button-addon2" name="title">
        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Sehrch</button>
    </div>
</form>
<div class="d-flex justify-content-center align-items-center">
    <div id="scrol-table">
        <table class="table table-bordered tabel-shadow align-middle mb-0 bg-white">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Description</th>
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
                                <div class="ms-1">
                                    <p class="fw-bold mb-1"><?= $i++ ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/images_item/<?= $item->img ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                <div class="ms-3">
                                    <p class="fw-bold text-center mt-2"><?= $item->title ?></p>
                                </div>
                            </div>
                        </td>

                        <td class="text-center pt-2"><span style="font-weight: bold;">$<?= $item->price ?></span></td>
                        <td>
                            <p class="fw-bold text-center mt-2"><?= !empty($item->description) ?  $item->description : '<span style="text-decoration: line-through; color:red;"> no desription  </span>'  ?></p>
                        </td>
                        <td class="text-center test"><span style="font-weight: bold;"> <?= $item->quantity ?></span></td>
                        <td class="text-center test">
                            <a href="./item?id=<?= $item->id; ?>" <i style="text-decoration: none; color:green;" class="fa-solid fa-check"></a></i>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
</div>