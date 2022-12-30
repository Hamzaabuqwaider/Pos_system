<div class="form-body">
    <div class="row">
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h2 class="text-center">Edit Transaction</h2>
                    <form action="/account/update" method="POST">
                        <input type="hidden" name="id" value="<?= $data->transaction->id ?>">
                        <input type="hidden" name="item_id" value="<?= $data->transaction->item_id ?>">
                        <div class="col-md-12 ">
                            <input onfocus="this.style.color='#000000'" class="form-control" type="text" value="<?= $_GET['item_name'] ?>" disabled>
                        </div>

                        <div class="col-md-12 ">
                            <input onfocus="this.style.color='#000000'" class="form-control" type="text" value="$ <?= $data->transaction->total ?>" disabled>
                        </div>

                        <div class="col-md-12 ">
                            <input onfocus="this.style.color='#000000'" class="form-control" type="text" name="quantity" placeholder="<?= $data->transaction->quantity ?>" value="">
                        </div>

                        <div class="col-md-12 ">
                            <input onfocus="this.style.color='#000000'" class="form-control" type="text" placeholder="" value="Last Updated : <?= $data->transaction->updated_at ?>">
                        </div>
                        <div class="form-button mt-3">
                            <button type="submit" class="btn btn-warning mt-4 mb-2">Update</button>
                            <a href="/accounts/page" class="btn btn-danger ms-3 mt-4 mb-2">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>