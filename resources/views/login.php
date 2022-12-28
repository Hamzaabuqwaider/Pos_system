<div class="container">
    <div class="wrapper">
        <div class="title"><span>POS System</span></div>
        <form method="POST" action="/authenticate">
            <div class="row">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder=Username" required>
            </div>
            <div class="row">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder=" Password" required>
            </div>
            <div class="row button">
                <input type="submit" value="Login">
            </div>
            <div class="rowx">
                <label for="remember">Remember me</label>
                <input type="checkbox" id="remember" name="remember_me">
            </div>

        </form>

    </div>
</div>