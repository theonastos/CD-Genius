function deleteRow(id)
{ 
	if(confirm("Are you sure you want to delete this row with product id": + id +"?") == true)
		window.location="../admin/admin_panel.php?del="+id;
	return false;
}