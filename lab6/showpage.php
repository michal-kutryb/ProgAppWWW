<?php
function PokazPodstrone($id)
{
	//czyscimy $id, aby przez GET ktoś nie probował wykonać ataku SQL INJECTION 
	$id_clear = htmlspecialchars($id);

    global $link;

	$query="SELECT page_content FROM page_list WHERE id='$id_clear' LIMIT 1";
	$result = mysqli_query($link,$query);

	//wywoływanie strony z bazy
	if ($result && $row = mysqli_fetch_assoc($result))
	{
		return $row['page_content'];
	}

	return '[nie_znaleziono_strony]';
}
?>