<?php
  // $ips = explode('||', $this->config->package_blacklist);
  // if (!in_array($this->system->ip, $ips)) {

	# Public Facing: UA-73077319-2
	# Studio Admin: G-ZT74Z3MSP1

  if($this->system->header->param == "admin") {
    $ga_code = 'G-ZT74Z3MSP1';
  } else {
    $ga_code = 'UA-73077319-2';
  }

?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= $ga_code ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?= $ga_code ?>');
</script>

<?php
  // }
?>
