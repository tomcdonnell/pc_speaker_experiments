<?php
/*
 * vim: ts=3 sw=3 et wrap co=100
 */

// Defines. ////////////////////////////////////////////////////////////////////////////////////////

define('MIN_FREQUENCY_HZ',     1);
define('MAX_FREQUENCY_HZ', 20000);

define('MIN_PITCH_MIDI',  69); // A4 =   440Hz.
define('MAX_PITCH_MIDI', 130); //   ~= 20000Hz.

// Global variables. ///////////////////////////////////////////////////////////////////////////////

$frequencyByNoteAbbrev = array
(
   'C'  => 261.6,
   'C#' => 277.2,
   'D'  => 293.7,
   'D#' => 311.1,
   'E'  => 329.6,
   'F'  => 349.2,
   'F#' => 370.0,
   'G'  => 392.0,
   'G#' => 415.3,
   'A'  => 440.0,
   'A#' => 466.2,
   'B'  => 493.9,
   'C'  => 523.2
);

$fawnMelodyString = <<<STR
9 1
11 1
13 3
11 1
9 3
11 1
13 1
16 1
18 1
13 1
16 3
9 0.5
11 0.5
13 1
16 1
21 1
18 1
16 2
13 0.5
16 0.5
13 1
11 2
9 0.5
11 0.5
9 1
6 0.5
8 1
4 2
STR;

// Globally executed code. /////////////////////////////////////////////////////////////////////////

try
{
/*
   $substrings = array();
   foreach (array_values($frequencyByNoteAbbrev) as $f)
   {
      $substrings[] = "-f $f";
   }

   playSounds($substrings);
*/
/*
   $substrings = array();
   for ($p = MIN_PITCH_MIDI; $p < MAX_PITCH_MIDI; $p += 1)
   {
      $f            = 440 * pow(2, ($p - 69) / 12);
      $substrings[] = "-f $f -l 50";
   }
*/
   $fawnNoteStrings = explode("\n", $fawnMelodyString);

   foreach ($fawnNoteStrings as $noteString)
   {
      list($note, $duration) = explode(' ', $noteString);

      $p = $note     +  61;
      $l = $duration * 600;
      $f = round(440 * pow(2, ($p - 69) / 12), 2);

      $substrings[] = "-f $f -l $l";
   }

   playSounds($substrings);
}
catch (Exception $e)
{
   echo $e->getMessage();
}

// Functions. //////////////////////////////////////////////////////////////////////////////////////

/*
 *
 */
function playSounds($substrings)
{
   $command = 'beep ' . implode(' -n ', $substrings);
   echo "$command\n\n";

   echo 'Playing sounds...';
   $output = exec($command);
   echo "done.\n";
   echo "$output\n";
}
