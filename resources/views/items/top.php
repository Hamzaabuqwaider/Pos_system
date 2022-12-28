<h1 class="d-flex justify-content-around mb-5">Top 5 Items</h1>

<div class="row d-flex justify-content-center align-items-center">
    <table class="table table-striped ">
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
            <?php foreach ($data->items as $item) : ?>
                <tr class="table-info">
                    <td scope="row"><?= $item->id ?></td>
                    <td class="text-center"><?= $item->title ?></td>
                    <td class="text-center">$<?= $item->cost ?></td>
                    <td class="text-center">$<?= $item->price ?></td>
                    <td class="text-center"><a href="/item?id=<?= $item->id ?>" class="btn btn-primary text-center">Check Item</a></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>