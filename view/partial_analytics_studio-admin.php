<?php
	$ips = explode('||', $this->config->package_blacklist);
	if (!in_array($this->system->ip, $ips)) {
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZT74Z3MSP1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ZT74Z3MSP1');
</script>

<?php 
	} 
?>
	