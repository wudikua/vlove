<?php
if (isset($_REQUEST['backurl'])) {
	$backurl = urlencode($_REQUEST['backurl']);
} else {
	$backurl = "http%3A%2F%2Fwap.datougou.cn%2Findex.php";
}
setcookie("gatethrough", "1");
header("Location: http://www.weixingate.com/gate.php?back=$backurl&force=1&info=force");