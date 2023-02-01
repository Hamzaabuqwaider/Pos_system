</div>
</div>
</div>


<footer class="d-flex justify-content-center align-items-center">
    <p class="m-0">&copy; <?= date('Y') ?> - All rights reserved to HTU</p>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/js/app.js"></script>
<script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
<script src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/js/app2.js"></script>
<script>
    <?php if (isset($_SESSION['message'])) : ?>
        swal({
            title: '<?= $_SESSION['message'] ?>',
            text: 'Redirecting...',
            icon: '<?= $_SESSION['error_type'] ?>',
            timer: 2000,
            buttons: false,
        });
    <?php unset($_SESSION['message']);
    endif; ?>
</script>
</body>

</html>