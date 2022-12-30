<h2 class="" style="font-style:italic;">Edit Transaction</h2>

<div class="form-body">
    <div class="row">
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <form action="/transactions/update" method="POST">
                        <input type="hidden" name="id" value="<?= $data->transaction->id ?>">
                        <input type="hidden" name="item_id" value="<?= $data->transaction->item_id ?>">
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

                        <div class="col-md-12">
                            <input onfocus="this.style.color='#000000'" class="form-control" type="text" value="transaction_id : <?= $data->transaction->id ?>" disabled>
                        </div>

                        <div class="col-md-12">
                            <input onfocus="this.style.color='#000000'" class="form-control" type="text" value="item_id : <?= $data->transaction->item_id ?>" disabled>
                        </div>

                        <div class="col-md-12">
                            <input onfocus="this.style.color='#000000'" class="form-control" type="text" name="quantity" placeholder="quantity : <?= $data->transaction->quantity ?>" value="">

                            <div class="col-md-12">
                                <input onfocus="this.style.color='#000000'" class="form-control" type="text" name="total" value="$ <?= $data->transaction->total ?>" disabled>
                            </div>

                            <div class="col-md-12">
                                <input onfocus="this.style.color='#000000'" class="form-control" type="text" name="total" value="Last Updated : <?= $data->transaction->updated_at ?>" disabled>
                            </div>

                            <div class="form-button mt-3">
                                <button type="submit" class="btn btn-warning mt-4 mb-2">Update</button>
                                <a href="/transactions/page" class="btn btn-danger ms-3 mt-4 mb-2">Cancel</a>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>