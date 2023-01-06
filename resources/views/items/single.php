<!-- use Core\Helpers\Helper; -->
<div class="row d-flex justify-content-center align-items-center py-5">
    <div class="card card-mobile" style="width: 18rem; background:bottom">
        <div class="card-body card-height">
            <p class="card-text card-text-x text-center"><strong style="font-size: 35px;"><?= $data->item->title ?></strong></p>
            <p class="card-text card-text-x">Cost : <strong>$<?= $data->item->cost ?></strong></p>
            <p class="card-text card-text-x">Price : <strong>$<?= $data->item->price ?></strong></p>
            <p class="card-text card-text-x">Quantity : <strong><?= $data->item->quantity ?></strong></p>
            <p class="card-text card-text-x">description : <strong><?= !empty($data->item->description) ?  $data->item->description : '<span style="text-decoration: line-through; color:red;"> no desription  </span>'  ?></strong></p>
            <p class="card-text card-text-x">created_at : <strong><?= $data->item->created_at ?></strong></p>
            <div class="mt-4 d-flex flex-row justify-content-around gap-3">
                <a href="/items" <i class="fa-solid fa-backward fa-2x"></i></a>
                <a href="/items/edit?id=<?= $data->item->id ?>"><i style="color:#424200;" class="fa-solid fa-pen-to-square fa-2x"></i></a>
                <a href="/items/delete?id=<?= $data->item->id ?>" onclick="return confirm('Are You Sure Delete <?= $data->item->title ?>  ?')"><i style="color: red;" class="fa-solid fa-trash fa-2x"></i></a>
            </div>
        </div>
    </div>
</div>