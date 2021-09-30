<?php
function json2xml( $domNode ) {
    foreach( $domNode -> childNodes as $node) {
     if ( $node -> hasChildNodes() ) { json2xml( $node ); }
     else {
      if ( $domNode -> hasAttributes() && strlen( $domNode -> nodeValue ) ) {
       $domNode -> setAttribute( "nodeValue", $node -> textContent );
       $node -> nodeValue = "";
      }
     }
    }
   }
  
   function jsonOut( $file ) {
    $dom = new DOMDocument();
    $dom -> loadXML( file_get_contents( $file ) );
    json2xml( $dom );
    header( 'Content-Type: application/json' );
    return str_replace( "@", "", json_encode( simplexml_load_string( $dom -> saveXML() ), JSON_PRETTY_PRINT ) );
   }
  
   $output = jsonOut( 'https://feeds.feedburner.com/Davidsonbpe' );
  
   echo( $output );

?>