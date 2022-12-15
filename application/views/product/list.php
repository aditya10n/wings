<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product List</title>
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
                                    <span class="dot theme"></span>
                                </div>
                                <div class="col-4">
                                    <span class="dot"></span>
                                </div>
                                <div class="col-4">
                                    <span class="dot"></span>
                                </div>
                            </div>
                            <section>
                                <div>
                                    <section class="w-100 p-4 d-flex justify-content-center pb-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="table_list"></table>
                                                <br>
                                                <br>
                                                <div class="text-center">
                                                    <button type="button" onclick="checkout()" id="checkout" class="btn btn-block mb-6 rounded-pill" style="width: 200px; color:white; background-color: #3bc9f5;" disabled>CHECKOUT</button>
                                                    <br>
                                                    <button type="button" onclick="report()" id="report-btn" class="btn btn-block mb-6 rounded-pill" style="width: 200px; color:white; background-color: #1ba1f8">REPORT LIST</button>
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
    <div class="row" hidden id="detail">
        <div class="col-md-6" style="float:none;margin:auto;">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-center">PRODUCT DETAIL</h4>
                            <br>
                            <section>
                                <div>
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <span class="btn btn-block block theme" style="width: 150px; height: 150px;"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 id="detail-nama">Nama</h4>
                                            <span id="detail-discount">discount</span>
                                            <span id="detail-price">price</span> <br>
                                            <span id="detail-dimension">dimension</span> <br>
                                            <span id="detail-unit">unit</span>

                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6 text-right">
                                            <br>
                                            <button id="buy_detail" class="btn btn-block mb-6 rounded-pill" style="width: 150px; height: 35px; color:white; background-color: #3bc9f5;">BUY</button>
                                        </div>
                                    </div>

                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
    var products = <?php echo json_encode($products); ?>;
    var buys = [];
    // console.log(products);
    loadList();

    function report() {
        window.location.href = "<?php echo site_url('Products/report/'); ?>";
    }

    function loadList() {
        html = '';
        for (let index = 0; index < products.length; index++) {
            html += '<tr>';
            html += '<td style="padding-right: 10px;"><button type="button" class="btn btn-block block theme" onclick="detail(\'' + products[index]['product_code'] + '\')"></button></div></td>';
            html += '<td style="padding-right: 50px;">' + products[index]['product_name'] + '<br>';

            strike = "";
            strike2 = "";
            if (products[index]['discount'] != 0) {
                strike = "<s>";
                strike2 = "</s>";
            }
            html += strike + rupiah(parseInt(products[index]['price'])) + strike2 + '<br>';
            html += (products[index]['discount'] != 0) ? rupiah(products[index]['price'] - (products[index]['price'] * products[index]['discount'] / 100)) : '&nbsp';
            html += '<td><button type="button" onclick="buy(\'' + products[index]['product_code'] + '\')" id="buy_' + products[index]['product_code'] + '" class="buy-btn btn btn-block mb-6 rounded-pill" style="width: 60px; color:white; background-color: #3bc9f5;">BUY</button></td>';
        }
        document.getElementById("table_list").innerHTML = html;
    }

    function buy(code) {
        document.getElementById('buy_' + code).innerHTML = "X";
        document.getElementById('buy_' + code).setAttribute("onClick", "javascript: cancel('" + code + "');");
        // document.getElementById('checkout').disabled = false;
        buys.push(code);
        setCheckout();
        closeDetail()
        console.log('buy', code);
    }

    function cancel(code) {
        document.getElementById('buy_' + code).innerHTML = "BUY";
        document.getElementById('buy_' + code).setAttribute("onClick", "javascript: buy('" + code + "');");
        console.log('sell', code);
        const index = buys.indexOf(code);
        if (index > -1) {
            buys.splice(index, 1);
        }
        setCheckout();
        closeDetail()
        console.log('buy', code);
    }

    function setCheckout() {
        document.getElementById('checkout').disabled = buys.length == 0;
        console.log(buys.length, buys.length > 1);
    }

    function detail(code) {
        document.getElementById("detail").hidden = false;
        $.ajax({
            type: "GET",
            url: "<?= site_url('Products/get_detail/'); ?>" + code,
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                document.getElementById('detail-nama').innerHTML = data.product_name;
                
                strike = "";
                strike2 = "";
                if (data.discount != '0') {
                    strike = "<s>";
                    strike2 = "</s>";
                }

                strike + rupiah(parseInt(data.price)) + strike2 + '<br>';

                document.getElementById('detail-discount').innerHTML = strike + rupiah(parseInt(data.price))  + strike2 + '<br>';
                document.getElementById('detail-price').innerHTML = (data.discount != 0) ? rupiah((parseInt(data.price) - (parseInt(data.price) * parseInt(data.discount) / 100))) : '&nbsp';
                document.getElementById('detail-dimension').innerHTML = "Dimension : "+data.dimension;
                document.getElementById('detail-unit').innerHTML = "Price Unit : ",data.unit;
                var buy_button = document.getElementById('buy_'+ data.product_code);
                if (buy_button.innerHTML == "BUY"){
                    document.getElementById('buy_detail').setAttribute("onClick", "javascript: buy('" + data.product_code + "');");
                }else{
                    document.getElementById('buy_detail').setAttribute("onClick", "javascript: cancel('" + data.product_code + "');");
                }
                document.getElementById('buy_detail').innerHTML = buy_button.innerHTML;
            }
        });
    }

    function closeDetail(){
        document.getElementById("detail").hidden = true;
    }

    function rupiah(number){
        return Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number) ;
    }

    function checkout() {
        var doc_code = ''+(new Date()).getTime();
        doc_code = doc_code.substr(-12);
        save_header(doc_code);
        for (let i = 0; i < buys.length; i++) {
            save_tran(buys[i], doc_code);
        }
        closeDetail();
        window.location.href = "<?php echo site_url('Products/checkout/'); ?>"+doc_code;
    }

    function save_header(doc_code) {
        $.ajax({
            async:false,
            type: "POST",
            url: "<?= site_url('Products/save_tran_header/'); ?>" + doc_code,
            success: function(data) {}
        });
    }

    function save_tran(code, doc_code) {
        $.ajax({
            async:false,
            type: "POST",
            url: "<?= site_url('Products/save_tran_detail/'); ?>" + code + "/" + doc_code,
            success: function(data) {}
        });
    }
</script>



</html>