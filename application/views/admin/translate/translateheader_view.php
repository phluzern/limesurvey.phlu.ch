<div class="side-body">
    <h3><span class="fa fa-language text-success" ></span>&nbsp;&nbsp;<?php eT("Translate survey"); ?></h3>

    <div class="row">
        <div class="col-lg-12 content-right">
            <form name='translatemenu' id='translatemenu' action='<?php echo $this->createUrl("admin/translate/sa/index/surveyid/{$surveyid}/lang/{$tolang}");?>' method='get'  class="form-horizontal">
                <?php echo $adminmenu; ?>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 content-right">
            <h4>
                <?php eT("Translate survey");?>
            </h4>
