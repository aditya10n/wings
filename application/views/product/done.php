<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/components/modal/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>
<style>
    .dot {
        height: 25px;
        width: 25px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
    }

    .block {
        height: 80px;
        width: 80px;
        background-color: #bbb;
        border-radius: 10%;
        display: inline-block;
    }

    .theme {
        background-color: #3bc9f5;
    }
</style>

<body>
    <div class="row">
        <br>
    </div>
    <div class="row">
        <div class="col-md-6" style="float:none;margin:auto;">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row text-center">
                                <div class="col-4">
                                    <span class="dot"></span>
                                </div>
                                <div class="col-4">
                                    <span class="dot"></span>
                                </div>
                                <div class="col-4">
                                    <span class="dot theme"></span>
                                </div>
                            </div>
                            <section>
                                <div>
                                    <section class="w-100 p-4 d-flex justify-content-center pb-4">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h2>Thank You</h2>
                                                CODE  : <span id="doc_code"><?= $header->document_code ?></span><br>
                                                TOTAL : <span id="total"><?= $header->total ?></span>
                                                <br>
                                                <br>
                                                <div class="text-center">
                                                    <button type="button" onclick="done()" id="checkout" class="btn btn-block mb-6 rounded-pill" style="width: 200px; color:white; background-color: #3bc9f5;">CONFIRM</button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <br>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
    var total = <?php echo json_encode($header->total); ?>;
    document.getElementById('total').innerHTML = rupiah(parseInt(total));
    function done(){
        window.location.href = "<?php echo site_url('Login/logout/'); ?>";
    }

    function rupiah(number){
        return Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
    }
</script>