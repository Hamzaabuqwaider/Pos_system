<h1 class="mb-5" style="font-family: 'Roboto', sans-serif;">Messages Page</h1>
<?php if (!empty($data->contacts)) { ?>

    <div class="d-flex justify-content-center align-items-center table-style">
        <div class="table-flex">
            <table class="table table-bordered tabel-shadow align-middle mb-0 bg-white">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Message</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="contacts-message">


                </tbody>
            </table>
        </div>
    </div>
<?php
} else {
    echo '<div class="alert alert-danger" role="alert">
    No message yet!
  </div>';
} ?>