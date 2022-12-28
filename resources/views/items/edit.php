<div class="form-body">
    <div class="row">
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h2 class="text-center">Edit Item</h2>
                    <form action="/items/update" method="POST">
                        <input type="hidden" name="id" value="<?= $data->item->id ?>">
                        <?php
                        if (!empty($_SESSION) && isset($_SESSION['errors']) && !empty($_SESSION['errors'])) : ?>
                            <?php foreach ($_SESSION['errors'] as $errors) : ?>
                                <div class='alert alert-danger mb-3' role='alert'>
                                    <?= $errors ?>
                                </div>
                            <?php endforeach; ?>
                        <?php
                            $_SESSION['errors'] = null;
                        endif; ?>

                        <div class="col-md-12 ">
                            <input  onfocus="this.style.color='#000000'" class="form-control" type="text" name="title" placeholder="Item Title" value="<?= $data->item->title ?>" required">

                        </div>

                        <div class=" col-md-12 mt-3">
                            <input  onfocus="this.style.color='#000000'" class="form-control " type="number" name="cost" placeholder="Item Cost" value="<?= $data->item->cost ?>" required>
                        </div>
                        <div class=" col-md-12 mt-3">
                            <input  onfocus="this.style.color='#000000'" class="form-control" type="number" name="price" placeholder="Item Price" value="<?= $data->item->price ?>" required>

                        </div>
                        <div class="col-md-12 mt-3">
                            <input  onfocus="this.style.color='#000000'" class="form-control" type="number" name="quantity" value="<?= $data->item->quantity ?>" placeholder="Quantity" required>

                        </div>

                        <div class="col-md-12 mt-3">
                            <textarea class="form-control"  onfocus="this.style.color='#000000'" placeholder="Your Item Description..(Optional)" id="post-content" style="height: 100px" name="description"><?= $data->item->description ?></textarea>
                        </div>

                        <div class="form-button mt-3">
                            <button type="submit" class="btn btn-warning mt-4 mb-2">Update</button>
                            <a href="/item?id=<?= $data->item->id ?>" class="btn btn-danger ms-3 mt-4 mb-2">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>