<?php

include("./lib/data.inc");

$data = new data();
$result = $data->DoQuery("select id, name,codegenname from cc_coupons order by ID desc");

//loop and fill this out

$uri = "http://www.couponcommando.com/coupon/specials";

$RSS = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\" ?>
<rss version=\"2.0\">
<channel>
	<link>http://www.couponcommando.com/</link>
    	<description>RSS feed</description>
";


foreach($result as $row){
	$RSS= $RSS."
	<item>
	<title>".$row['name']."</title>
        <link>".$uri."/".$row['codegenname']."</link>
	</item>";
}

$RSS=$RSS."
  </channel>
</rss>
";

echo($RSS);
?>
