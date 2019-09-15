<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      
      <p><?php echo $partner_desc0; ?></p>
      <p><?php echo $partner_desc1; ?></p>
      <p><?php echo $partner_desc2; ?></p>
      <p><?php echo $partner_desc3; ?></p>
      <p><?php echo $partner_desc4; ?></p>
      <p><?php echo $partner_desc5; ?></p>
      <p><?php echo $partner_desc6; ?></p>
      <p><?php echo $partner_desc7; ?></p>
      <p><?php echo $partner_desc8; ?></p>
      <p><?php echo $partner_desc9; ?></p>
      
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
          <legend><?php echo $text_partner; ?></legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="first_name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="first_name" value="<?php echo $first_name; ?>" id="first_name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="last_name"><?php echo $entry_last_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="last_name" value="<?php echo $last_name; ?>" id="last_name" class="form-control" />
              <?php if ($error_last_name) { ?>
              <div class="text-danger"><?php echo $error_last_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="firm"><?php echo $entry_firm; ?></label>
            <div class="col-sm-10">
              <input type="text" name="firm" value="<?php echo $firm; ?>" id="firm" class="form-control" />
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
            <div class="col-sm-10">
              <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
              <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="taxes"><?php echo $entry_taxes; ?></label>
            <div class="col-sm-10">
              <select name="taxes" id="taxes" class="form-control">
              		<option value=""> <?php echo $text_taxes; ?> </option>
              	<?php foreach($taxes_forms as $tax){	echo '<option value="' . $tax['forms'] . '">' . $tax['forms'] . '</option>'; } ?>
              </select>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="age"><?php echo $entry_age; ?></label>
            <div class="col-sm-10">
              <input type="text" name="age" value="<?php echo $age; ?>" id="age" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="comments"><?php echo $entry_comments; ?></label>
            <div class="col-sm-10">
              <textarea name="comments" rows="10" id="comments" class="form-control"><?php echo $comments; ?></textarea>
              <?php if ($error_enquiry) { ?>
              <div class="text-danger"><?php echo $error_enquiry; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="document"><?php echo $entry_document; ?></label>
            <div class="col-sm-10">
              <input type="file" name="document" id="document">
              
              <?php if ($error_file) { ?>
              <div class="text-danger"><?php echo $error_file; ?></div>
              <?php } ?>
            </div>
          </div>
        </fieldset>
        <div class="buttons">
          <div class="pull-right">
            <input class="btn btn-primary" type="submit" value="<?php echo $button_submit; ?>" />
          </div>
        </div>
      </form>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>