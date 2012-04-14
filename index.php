<?php
/*
 * vim: ts=3 sw=3 et wrap co=100
 */

// Defines. ////////////////////////////////////////////////////////////////////////////////////////

define('N_NOTES_PER_OCTAVE'  , 12);
define('N_OCTAVES_TO_DISPLAY',  4);
define('A440HZ_OCTAVE_NO'    ,  1);

// Global variables. ///////////////////////////////////////////////////////////////////////////////

$filesCss = array
(
   'style.css'
);

$filesJs = array
(
   '../library/tom/js/contrib/jquery/1.5/jquery_minified.js',
   '../library/tom/js/utils/utils.js'                       ,
   '../library/tom/js/utils/utilsValidator.js'              ,
   'main.js'
);

// Functions. //////////////////////////////////////////////////////////////////////////////////////

/*
 *
 */
function echoHtmlForMusicGrid($indent)
{
   $i = &$indent; // Abbreviation.

   echo "$i<table>\n";
   echo "$i <tbody>\n";

   for ($r = 0; $r < N_OCTAVES_TO_DISPLAY * N_NOTES_PER_OCTAVE; ++$r)
   {
      $classString =
      (
         ($r % N_NOTES_PER_OCTAVE == 0)? ' class=\'topBorderOctaveBoundary\'':
         (
            (($r + 1) % N_NOTES_PER_OCTAVE == 0)? ' class=\'bottomBorderOctaveBoundary\'': ''
         )
      );

      echo "$i  <tr$classString>\n";

      for ($c = 0; $c < 128; ++$c)
      {
         echo
         (
            ($c == 0)?
            "$i<th>" . getNoteAbbrevFromRowNo($r) . "</th>\n":
            "$i<td>$value</td>\n"
         );
      }

      echo "  </tr>\n";
   }

   echo "$i </tbody>\n";
   echo "$i</table>\n";
}

/*
 *
 */
function getNoteAbbrevFromRowNo($r)
{
   $octaveNo           = floor($r / N_NOTES_PER_OCTAVE);
   $noteAbbrevByOffset = array('G','F#','F','E#','E','D#','D','C#','C','B','A#','A');

   for ($offset = 0; $offset < N_NOTES_PER_OCTAVE; ++$offset)
   {
      if (($r - $offset) % N_NOTES_PER_OCTAVE == 0)
      {
         $midiNoteNo =
         (
            ((N_OCTAVES_TO_DISPLAY - $octaveNo) * N_NOTES_PER_OCTAVE) +
            ((A440HZ_OCTAVE_NO * 12) + 32) - $offset
         );

         return "$midiNoteNo {$noteAbbrevByOffset[$offset]}";
      }
   }
}

// HTML code. //////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE HTML>
<html>
 <head>
  <title>Funtastical Tunistic Melodical Compositor</title>
  <link rel='stylesheet' type='text/css' href='style.css'/>
<?php
$unixTime = time();
foreach ($filesJs  as $file) {
   echo "  <script type='text/javascript' src='$file?$unixTime'></script>\n";
}
foreach ($filesCss as $file) {
   echo "  <link rel='stylesheet' type='text/css' href='$file?$unixTime'/>\n";
}
?>
 </head>
 <body>
  <h1>Funtastical Tunistic Melodical Compositor</h1>
<?php
echoHtmlForMusicGrid('   ');
?>
  <br/>
  <input type='button' value='Load'/>
  <input type='button' value='Save'/>
  <input type='button' value='Play'/>
 </body>
</html> 
