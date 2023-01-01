<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    <?php if (isset($_SESSION['message'])) : ?>
        swal({
            title: '<?= $_SESSION['message'] ?>',
            text: 'Redirecting...',
            icon: 'warning',
            timer: 2000,
            buttons: false,
        });
    <?php unset($_SESSION['message']);
    endif; ?>
</script>

</body>

</html>