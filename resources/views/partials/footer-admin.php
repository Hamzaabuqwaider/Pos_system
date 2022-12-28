</div>
</div>
</div>


<footer class="d-flex justify-content-center align-items-center">
    <p class="m-0">&copy; <?= date('Y') ?> - All rights reserved to HTU</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="<?= "http://" . $_SERVER['HTTP_HOST'] ?>/resources/js/app.js""></script>
<script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>

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

<script>
    const link = window.location.href;
    const active = document.querySelectorAll("ul li a").forEach((item) => {
        if (item.href == link) {
            item.classList.add("active-5");
        }
    });


    const one = document.getElementById('Card-1');
    const two = document.getElementById('Card-2');
    const three = document.getElementById('Card-3');
    const four = document.getElementById('Card-4');
    const five = document.getElementById('Card-5');

    const arr = [
        'Users', 'Total Items', 'Total Sales', 'Total Transaction', 'Total quantity'
    ];

    let num = 0;

    function border() {
        if (arr[num] === "Users") {
            five.classList.remove("card-scale");

            one.classList.add("card-scale");
            num = 1;
        } else if (arr[num] === "Total Items") {
            one.classList.remove("card-scale");
            two.classList.add("card-scale");
            num = 2;
        } else if (arr[num] === "Total Sales") {
            two.classList.remove("card-scale");
            three.classList.add("card-scale");
            num = 3;
        } else if (arr[num] === "Total Transaction") {
            three.classList.remove("card-scale");
            four.classList.add("card-scale");
            num = 4;
        } else if (arr[num] === "Total quantity") {
            four.classList.remove("card-scale");
            five.classList.add("card-scale");
            num = 0;
        } else {
            return;
        }
    }

    setInterval(() => {
        border();
    }, 1800)
</script>

</body>

</html>