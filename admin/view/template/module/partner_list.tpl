<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-customer').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="last_name"><?php echo $entry_last_name; ?></label>
                <input type="text" name="filter_last_name" value="<?php echo $filter_last_name; ?>" placeholder="<?php echo $entry_last_name; ?>" id="last_name" class="form-control" />
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="taxes"><?php echo $entry_taxes; ?></label>
                <select name="filter_taxes" id="taxes" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_taxes) { ?>
                  <option value="<?php echo $filter_taxes; ?>" selected><?php echo $filter_taxes; ?></option>
                  <?php } ?>
                  
                  <?php foreach ($taxes_forms as $taxes_form) { ?>
                  <option value="<?php echo $taxes_form['forms']; ?>" ><?php echo $taxes_form['forms']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status && !is_null($filter_status)) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-sm-3">
			  <div class="form-group">
                <label class="control-label" for="firm"><?php echo $entry_firm; ?></label>
                <input type="text" name="filter_firm" value="<?php echo $filter_firm; ?>" placeholder="<?php echo $entry_firm; ?>" id="firm" class="form-control" />
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-customer">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php if ($sort == 'name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'last_name') { ?>
                    <a href="<?php echo $sort_last_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_last_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_last_name; ?>"><?php echo $column_last_name; ?></a>
                    <?php } ?></td>
                  <td class="text-left">
                    <?php echo $column_email; ?>
                    </td>
                  <td class="text-left"><?php if ($sort == 'firm') { ?>
                    <a href="<?php echo $sort_firm; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_firm; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_firm; ?>"><?php echo $column_firm; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'c.status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'taxes') { ?>
                    <a href="<?php echo $sort_taxes; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_taxes; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_taxes; ?>"><?php echo $column_taxes; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php echo $column_age; ?></td>
                  <td class="text-left"><?php echo $column_document; ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($partners) { ?>
                <?php foreach ($partners as $partner) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($partner['partner_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $partner['partner_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $partner['partner_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $partner['name']; ?></td>
                  <td class="text-left"><?php echo $partner['last_name']; ?></td>
                  <td class="text-left"><?php echo $partner['email']; ?></td>
                  <td class="text-left"><?php echo $partner['firm']; ?></td>
                  <td class="text-left"><?php echo $partner['status']; ?></td>
                  <td class="text-left"><?php echo $partner['taxes']; ?></td>
                  <td class="text-left"><?php echo $partner['age']; ?></td>
                  
                  <td class="text-left"><a href="<?php echo $partner['document'] ? "dl_save.php?filename=" . DIR_DOWNLOAD . $partner['document'] : ""; ?>" target="_blank" download=""><?php echo $partner['document'] ? $partner['document'] : ""; ?></a></td>
                  <td class="text-right">
                    <a href="<?php echo $partner['status'] == 'Не рассмотрено' ? "index.php?route=module/partner/edit&token=" . $partner['token'] . "&partner_id=" . $partner['partner_id'] : "index.php?route=module/partner&token=" . $partner['token'] ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-success" <?php echo  $partner['status'] == 'Рассмотрено' ? "disabled" : "" ?>  ><i class="fa fa-thumbs-o-up"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=module/partner&token=<?php echo $token; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').val();
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_last_name = $('input[name=\'filter_last_name\']').val();
	
	if (filter_last_name) {
		url += '&filter_last_name=' + encodeURIComponent(filter_last_name);
	}
	
	var filter_firm = $('input[name=\'filter_firm\']').val();
	
	if (filter_firm) {
		url += '&filter_firm=' + encodeURIComponent(filter_firm);
	}	
	
	var filter_status = $('select[name=\'filter_status\']').val();
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status); 
	}	
	
	var filter_taxes = $('select[name=\'filter_taxes\']').val();
	
	if (filter_taxes != '*') {
		url += '&filter_taxes=' + encodeURIComponent(filter_taxes);
	}	
	
	location = url;
});
//--></script> 


 
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script></div>
<?php echo $footer; ?> 
