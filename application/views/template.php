<?php $this->load->view('common/header');?>

<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
     data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

    <?php $this->load->view('common/topbar');?>
    <?php $this->load->view('common/leftbar');?>
    <?php $this->load->view('start');?>

</div>
<?php $this->load->view('modal/addTask');?>
<?php $this->load->view('modal/editTask');?>
<?php $this->load->view('modal/errors_validate');?>
<?php $this->load->view('modal/profile_settings');?>
<?php $this->load->view('modal/topbar-balance');?>

<?php $this->load->view('common/footer');?>