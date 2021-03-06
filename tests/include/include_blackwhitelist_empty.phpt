--TEST--
Include URL with empty black-/whitelist
--SKIPIF--
<?php include "../skipifcli.inc"; ?>
--INI--
suhosin.log.syslog=0
suhosin.log.sapi=255
suhosin.log.script=0
suhosin.log.phpscript=0
suhosin.executor.include.whitelist=
suhosin.executor.include.blacklist=
--FILE--
<?php
	$var = dirname(__FILE__) . "/../empty.inc";
	include $var;
	echo $value,"\n";
    $var = "foo://test";
    include $var;
	$var = "boo://test"; // this point is never reached (famous last words)
	include $var;
?>
--EXPECTF--
value-from-empty.inc
ALERT - Include filename ('foo://test') is a URL that is not allowed (attacker 'REMOTE_ADDR not set', file '%s', line 6)