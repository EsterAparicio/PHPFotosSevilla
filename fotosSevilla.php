<?php
# Necesita el param GET tag, en la petición. Algunos ejemplos:
# localhost/<path_al_script>/procesoXML.php?tag=sevilla
# localhost/<path_al_script>/procesoXML.php?tag=mountain
# localhost/<path_al_script>/procesoXML.php?tag=tree
header('Content-Type: text/html; charset=utf-8');
$tag = "sevilla";
$url = "https://api.flickr.com/services/feeds/photos_public.gne?tags=".$tag;

$texto = file_get_contents($url);
$tree = new SimpleXMLElement($texto);
$tree->registerXPathNamespace("feed","http://www.w3.org/2005/Atom");
$links = $tree->xpath("//feed:entry/feed:link[@rel='enclosure']/@href");
echo "<h1 align='center'>Últimas fotos con la etiqueta ".$tag."</h1>";
$tabla = "";
$contador = 0;
	foreach($links as $i => $v) {
		if ($contador<30) {
			$tabla = $tabla.
			"<tr>
				<td width='300px'>
					<b>Título</b><br><a href='".$links[$i]."'<br>"
					.$tree->entry[$i]->title."</a><br>
				</td></tr>";
			$contador = $contador + 1;
		}}
		echo "<table align='center'bgcolor='#F2F2F2' cellpadding='20px'>".$tabla."</table>";
	?>
