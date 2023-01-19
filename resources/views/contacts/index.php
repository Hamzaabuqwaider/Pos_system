<?php

use Core\Model\Contact;
use Core\Model\User; ?>
<div class="d-flex justify-content-center align-items-center flex-wrap">
    <?php if (!empty($data->contacts_replay_all)) { ?>
        <div class="ms-3 w-50">
            <table class="table table-bordered tabel-shadow align-middle mb-0 bg-white">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Message replay</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;

                    foreach ($data->contacts_replay_all as $contact) : ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="ms-1">
                                        <p class="fw-bold mb-1"><?= $i++ ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center pt-2"><span style="font-weight: bold; color:green;"><?= $contact->mesaage_replay ?></span></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php } else {
        echo '<div class="alert alert-danger" role="alert">
            No replay message yet!
          </div>';
    }
    ?>
    <div class="ms-3">
        <div class="card card-profile height-card mb-4">
            <form class="card-body" method="post" action="/contact/store">
                <input type="hidden" value="<?= $_SESSION['user']['user_id']; ?>" name="user_id">
                <?php
                $id = $_SESSION['user']['user_id'];
                // $sql = "SELECT img FROM users WHERE id = $id";
                $user = new User();
                $user_info = $user->get_by_id($id);
                ?>
                <div class="col-sm-3 w-100 mb-4">
                    <p class="mb-1" style="color:red ;font-weight:bold">Email :</p>
                    <input type="text" name="email" value="<?= $user_info->email ?>" class="form-control">
                </div>
                <div class="form-outline col-sm-3 w-100">
                    <p class="mb-1" style="color:red ;font-weight:bold">Message :</p>
                    <textarea class="form-control" name="message_contact" id="textAreaExample1" placeholder="Enter Your Problem .." rows="4" required></textarea>
                </div>

                <div class="col-sm-3 mt-2">
                    <button type="submit" class="btn btn-success">Primary</button>
                </div>
            </form>
        </div>
    </div>
</div>