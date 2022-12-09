<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
    var products = <?php echo json_encode($products); ?>;
    var buys = [];
    // console.log(products);
    loadList();
    function loadList(){
        html = '';
        for (let index = 0; index < products.length; index++) {
            // html += '<tr>' ; 
            // html += '<td rowspan="3" style="padding-right: 10px;"><span class="block theme"></span></div></td>' ;
            // html += '<td style="padding-right: 50px;">'+products[index]['product_name']+'</td>' ;
            // html += '<td rowspan="3"><button type="button" class="btn btn-block mb-6 rounded-pill" style="width: 60px; color:white; background-color: #3bc9f5;">BUY</button></td>' ;
            // html += '</tr>' ;
            // html += '<tr>' ;
            // html += '<td>Rp. '+products[index]['price']+'</td>' ;
            // html += '</tr>' ;
            // html += '<tr>' ;
            // // html += '<td>'+(products[index]['discount'] != 0) ? 'Rp. ' +(products[index]['price'] - (products[index]['price'] * products[index]['discount'] )) : '&nbsp' +'</td>' ;
            // html += '</tr>';


            html += '<tr>' ; 
            html += '<td style="padding-right: 10px;"><span class="block theme"></span></div></td>' ;
            html += '<td style="padding-right: 50px;">'+products[index]['product_name']+'<br>' ;
            
            strike = "";
            strike2 = "";
            if (products[index]['discount'] != 0){
                strike = "<s>";
                strike2 = "</s>";
            }
            html += strike+'Rp. '+products[index]['price']+strike2+'<br>' ;
            html += (products[index]['discount'] != 0) ? 'Rp. ' +(products[index]['price'] - (products[index]['price'] * products[index]['discount'] / 100 )) : '&nbsp' ;
            html += '<td><button type="button" onclick="buy(\''+products[index]['product_code']+'\')" id="buy_'+products[index]['product_code']+'" class="btn btn-block mb-6 rounded-pill" style="width: 60px; color:white; background-color: #3bc9f5;">BUY</button></td>' ;
        }
        document.getElementById("table_list").innerHTML = html;
    }

    function buy(code){
        document.getElementById('buy_'+code).disabled = true;
        document.getElementById('checkout').disabled = false;
        console.log('buy',code);
        buys.push(code);
    }

    function detail(code){

    }

    function checkout(code){
        for (let index = 0; index < buys.length; index++) {
            var doc_code = "<?= substr(uniqid('', true),12) ?>";
            $.ajax({
                type: "POST",
                url: "<?= site_url('Products/save_tran_detail/'); ?>",
                data: {
                    "code": code,
                    "doc_code": doc_code
                },  
                success: function (data) {
                }
            });
        }
    }

</script>
</html>