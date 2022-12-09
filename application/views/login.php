<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="row">
        <br>
    </div>
    <div class="row">
        <div class="col-md-6" style="float:none;margin:auto;">
            <div class="card">
                <div class="card-body">
                    <section>
                        <div>
                            <section class="w-100 p-4 d-flex justify-content-center pb-4">
                                <form style="width: 22rem;" method="POST" action="<?= base_url('Login/login');?>">
                                    <h3 class="text-center" style="padding-top: 10px; padding-bottom: 60px">LOGIN</h3>
                                    <div class="form-outline mb-4">
                                        <input type="username" id="username" class="form-control" name="username">
                                        <div class="form-notch">
                                            <div class="form-notch-leading" style="width: 9px;"></div>
                                            <div class="form-notch-middle" style="width: 88.8px;"></div>
                                            <div class="form-notch-trailing"></div>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" class="form-control" name="password">
                                        <div class="form-notch">
                                            <div class="form-notch-leading" style="width: 9px;"></div>
                                            <div class="form-notch-middle" style="width: 64px;"></div>
                                            <div class="form-notch-trailing"></div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-block mb-6 rounded-pill" style="width: 200px; color:white; background-color: #3bc9f5;">LOGIN</button>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>