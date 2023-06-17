<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
        <!-- Styles -->
        <style>

            @media (min-width: 1025px) {
                .h-custom {
                height: 100vh !important;
                }
                }
                
                .card-registration .select-input.form-control[readonly]:not([disabled]) {
                font-size: 1rem;
                line-height: 2.15;
                padding-left: .75em;
                padding-right: .75em;
                }
                
                .card-registration .select-arrow {
                top: 13px;
                }
                
                .bg-grey {
                background-color: #eae8e8;
                }
                
                @media (min-width: 992px) {
                .card-registration-2 .bg-grey {
                border-top-right-radius: 16px;
                border-bottom-right-radius: 16px;
                }
                }
                
                @media (max-width: 991px) {
                .card-registration-2 .bg-grey {
                border-bottom-left-radius: 16px;
                border-bottom-right-radius: 16px;
                }
                }
        </style>
    </head>
    
    <body class="antialiased">
        
        <section class="h-100 h-custom" style="background-color: #d2c9ff;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-8">
                                        <div class="p-5">
                                            <div class="d-flex justify-content-between align-items-center mb-5">
                                                <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                                <h6 class="mb-0 text-muted">{{sizeof($data->items)}} items</h6>
                                            </div>
                                            @php
                                                $total_price = 0;
                                            @endphp
                                            @foreach($data->items as $item)
                                            <hr class="my-4">

                                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                <div class="col-md-2 col-lg-2 col-xl-2">
                                                    <img
                                                        src={{$item->product_details->url_images}}
                                                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-3">
                                                    <h6 class="text-black mb-0">
                                                        <p>{{$item->product_details->code_volume}}</p>
                                                        <p>{{$item->product_details->description}}</p>
                                                    </h6>
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                    <button class="btn btn-link px-2"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                        <i class="fas fa-minus"></i>
                                                    </button>

                                                    <input id="form1" min="0" name="quantity" value={{intval($item->quantity)}} type="number"
                                                        class="form-control form-control-sm" />

                                                    <button class="btn btn-link px-2"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                    <h6 class="mb-0">R${{$item->product_details->price}}</h6>
                                                </div>
                                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                    <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                                                </div>
                                            </div>
                                            @php
                                                $total_price += $item->product_details->price * $item->product_details->factor_quantity;
                                            @endphp

                                            @endforeach

                                            <hr class="my-4">

                                            <div class="pt-5 d-flex">
                                                <h6 class="mb-0"><a href="#!" class="text-body"><i
                                                    class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                                <h6 class="mb-0" style="margin-left: auto">TOTAL: R${{ $total_price }}</h6>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div id="sumup-card"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        <script src="https://gateway.sumup.com/gateway/ecom/card/v2/sdk.js"></script>
        <script type="text/javascript">
            var price = Number("<?php echo $total_price ?>");
            SumUpCard.mount({
                id: 'sumup-card',
                checkoutId: 'demo',
                showSubmitButton: true,
                externalSubmiEvent: false,
                selectedPaymentMethod: "card",
                showFooter: true,
                currency: "BRL",
                sessionId: "FTz-MYijZOCrBVYhS48PC",
                timestamp: "1686932148486",
                amount: price,
                onResponse: function (type, body) {
                console.log('Type', type);
                console.log('Body', body);
                if(type == "success") {
                    alert('payment is successful')
                }
                },
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
