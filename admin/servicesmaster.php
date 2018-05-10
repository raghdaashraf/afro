<?php

// title
// desc

?>
<?php if ($services->Visible) { ?>
<table id="t_services" class="ewGrid"><tr><td>
<table id="tbl_servicesmaster" class="table table-bordered table-striped">
	<tbody>
<?php if ($services->title->Visible) { // title ?>
		<tr id="r_title">
			<td><?php echo $services->title->FldCaption() ?></td>
			<td<?php echo $services->title->CellAttributes() ?>>
<span id="el_services_title" class="control-group">
<span<?php echo $services->title->ViewAttributes() ?>>
<?php echo $services->title->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($services->desc->Visible) { // desc ?>
		<tr id="r_desc">
			<td><?php echo $services->desc->FldCaption() ?></td>
			<td<?php echo $services->desc->CellAttributes() ?>>
<span id="el_services_desc" class="control-group">
<span<?php echo $services->desc->ViewAttributes() ?>>
<?php echo $services->desc->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</td></tr></table>
<?php } ?>
