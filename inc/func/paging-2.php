<? 
// Paging logic relative to PGNO varaible
$active_lnk = 0;
if(isset($_GET['rows_per_page']))
	$rows_per_page = $_GET['rows_per_page'];
else
	$rows_per_page = 10;

if (isset($_GET['page_no']))
	$active_lnk = $_GET['page_no'];
else
	$active_lnk = 1;

$st_rec = ($active_lnk - 1) * $rows_per_page + 1;
$ed_rec = $st_rec + $rows_per_page - 1;
?>
