<?php
if (isset($_REQUEST['backurl'])) {
	$backurl = urlencode(base64_decode($_REQUEST['backurl']));
} else {
	$backurl = "http%3A%2F%2Fwap.datougou.cn%2Findex.php";
}
header("Location: http://www.weixingate.com/gate.php?back=$backurl&force=1&info=force");