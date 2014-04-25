<?php
$feed = file_get_contents("http://www.google.com/books/feeds/volumes?q=3039106090");
$xml = new SimpleXmlElement($feed);
foreach ($xml->entry as $entry){
  $namespaces = $entry->getNameSpaces(true);
  $dc = $entry->children($namespaces['dc']); 
  echo $dc->format."<br/>";
  echo $dc->date."<br/>";
  echo $dc->description."<br/>";
  echo $dc->creator."<br/>";
  echo $dc->title."<br/>";
}
?>