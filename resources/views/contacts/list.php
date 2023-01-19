<h1 class="mb-5" style="font-family: 'Roboto', sans-serif;">Messages Page</h1>
<?php if (!empty($data->contacts)) { ?>
    <div class="d-flex justify-content-center align-items-center">
        <div id="scrol-table d-none">
            <table class="table table-bordered tabel-shadow align-middle mb-0 bg-white">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Message</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($data->contacts as $contact) : ?>
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
                                    <div class="ms-3">
                                        <p class="fw-bold text-center mt-2"><?= $contact->Email ?></p>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center pt-2"><span style="font-weight: bold;"><?= $contact->message_contact ?></span></td>

                            <td class="text-center test">
                                <a href="/message/replay?id=<?= $contact->id; ?>&user_contact=<?= $contact->user_id ?>" <i style="text-decoration: none; color:green;" class="fa-solid fa-reply pe-3"></a></i>
                                <a href="/delete/message?id=<?= $contact->id; ?>" <i style="text-decoration: none; color:red;" class="fa-solid fa-trash"></a></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>

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
</div>