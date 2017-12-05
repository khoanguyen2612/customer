
    <div class="user_pay">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <h4><i class="star"></i></h4>
                </div>

                <div class="col-lg-12">
                    <h4><i class="star"></i></h4>
                    <p class="title"></p>
                </div>

            </div>
        </div>
    </div>

    <style type="text/css">
        .user_pay{
            background-color: #f3f3f3;
        }
        .user_pay .row{
            margin-top: 10px;
            margin-bottom: 30px;
            padding-bottom: 60px;
            background-color: #fff;
        }
        .star{
            background: url(<?php echo $this->Html->url('/img/star_img.png');?>) no-repeat top;
            display: inline-block;
            width: 27px;
            height: 27px;
            margin-bottom: -6px;
            margin-right: 8px;
        }
        .user_pay h4{
            margin-top: 30px;
            color: #f37636;
            text-transform: uppercase;
            font-weight: 600;
        }
        .user_pay p.title{
            margin-top:20px;
            padding-left: 35px;
            font-size: 18px;
            color: #0060af;
        }
        .user_pay input[type=text]{
            border:solid 1px #29353f;
            width: 50%;
            margin: auto;
            display: block;
            height: 45px;
            padding-left: 10px;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        #pay_ol{
            font-weight: 600;
            font-size: 18px;
            border-radius: 4px;
            padding: 8px 0px;
            margin: 68px auto;
            text-align: center;
            width: 40%;
            background-color: #0060af;
            font-size: 18px;
            color: #fff;
        }

    </style>