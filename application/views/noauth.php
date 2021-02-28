<?php $this->load->view('common/header');?>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
         data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <?php $this->load->view('common/topbar');?>

    </div>

<style>
    .ad {

        font-size: 50px;
        color: #3a3a3a;
        font-family: Sans-serif, Arial, Tahoma;
        width: 70%;
        margin: 80px 0 0 50px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="
        background-image: url('/public/assets/images/bigCar.jpg');
        height: calc(100vh - 64px);
        background-size: cover;
        ">

            <div class="ad">
                Ваш самый быстрый источник информации о продаже автомобилей
            </div>


        </div>
    </div>
</div>

<?php $this->load->view('modal/auth');?>
<?php $this->load->view('modal/registration');?>
<?php $this->load->view('modal/errors_validate');?>
<?php $this->load->view('modal/recovery_password');?>
<?php $this->load->view('modal/recovery_success');?>
<?php $this->load->view('common/footer');?>