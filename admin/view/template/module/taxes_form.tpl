<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-customer" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo !$taxes_id ? "index.php?route=module/taxes/add&token=" . $token : "index.php?route=module/taxes/edit&token=" . $token . "&taxes_id=" . $taxes_id; ?>" method="post" enctype="multipart/form-data" id="form-customer" class="form-horizontal">
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="row">
                <div class="col-sm-10">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab-customer">
                      
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="forms"><?php echo $text_taxes; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="forms" value="<?php echo ($taxes_id) ? $taxes['forms'] : "" ?>" placeholder="<?php echo $text_taxes; ?>" id="forms" class="form-control" />
                        </div>
                      </div>


                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-ip">
              <div id="ip"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
