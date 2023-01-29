<div class="d-flex justify-content-between">
    <h1 style="font-family: 'Roboto', sans-serif;">Selling Page</h1>
</div>
<div class="form_style mb-4">
    <form id="userInputContainer">
        <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user']['user_id'] ?>">
        <div class="input-group div-padding">
            <span class="input-group-text" id="addon-wrapping">Items</span>
            <select id="items" class="form-select" aria-label="Default select example" required>
                <option selected>Select item name</option>
            </select>
        </div>
        <div class="input-group div-padding ps-2">
            <span class="input-group-text" id="addon-wrapping">Quantity</span>
            <input id="quantity" value="" type="number" class=" form-control" aria-describedby="addon-wrapping" min="0" required>
        </div>
        <div class="input-group div-padding ps-2">
            <span class="input-group-text" id="addon-wrapping">Total</span>
            <input id="price" type="text" value="" class="form-control" aria-describedby="addon-wrapping" min="0" required>
        </div>
        <button id="add-item" type="submit" class="ms-2 btn btn-success div-padding-b"></button>
    </form>
</div>
<div id="dataTableContainer">
    <div class="d-flex justify-content-end mb-3">
        <strong>Total Sales : $<span id="total-sales"></span></strong>

    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Item</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>